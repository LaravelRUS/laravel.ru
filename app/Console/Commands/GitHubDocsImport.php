<?php

/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Article;
use App\Models\Docs;
use App\Services\GitHub\DocsStatus;
use App\Services\GitHub\ExternalDocsPage;
use App\Services\GitHub\GitHubConfigRepository;
use App\Services\GitHub\GitHubDocsManager;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

/**
 * Class GitHubDocsImport.
 */
class GitHubDocsImport extends Command
{
    /**
     * The name and signature of the console command.
     * @var string
     */
    protected $signature = 'docs:import';

    /**
     * The console command description.
     * @var string
     */
    protected $description = 'Import documentation from GitHub.';

    /**
     * Execute the console command.
     * @param GitHubDocsManager      $manager
     * @param GitHubConfigRepository $config
     * @return void
     * @throws \Github\Exception\ErrorException
     * @throws \Github\Exception\InvalidArgumentException
     * @throws \RuntimeException
     */
    public function handle(GitHubDocsManager $manager, GitHubConfigRepository $config): void
    {
        $exists = $this->getDocsCurrentState(...$config->values());

        $files = $manager->findFiles(...$config->values())
            ->reject(function (DocsStatus $status) use ($exists) {
                return $exists->where('github_hash', $status->getHash())->first();
            })
            ->each(function (DocsStatus $status) use ($config, $manager) {
                $args = $config->values();
                $args[] = $status->getPath();

                /** @var ExternalDocsPage $page */
                $page = $manager->import(...$args);

                $docs = $this->getDocsModel(...$args);

                $docs->content_source = $page->getContent();
                $docs->github_hash = $status->getHash();

                if (!$docs->category_id) {
                    $docs->category_id = 0; // TODO
                }

                if (!$docs->title) {
                    $docs->title = Str::ucfirst(str_replace(
                        ['-', '_'],
                        ' ',
                        $page->getUrl()
                    ));
                }

                $docs->save();
            });
    }

    /**
     * @param string $org
     * @param string $repo
     * @param string $branch
     * @return Collection
     */
    private function getDocsCurrentState(string $org, string $repo, string $branch)
    {
        return Docs::query()
            ->where('github_org', $org)
            ->where('github_repo', $repo)
            ->where('github_branch', $branch)
            ->get(['github_hash']);
    }

    /**
     * @param string $org
     * @param string $repo
     * @param string $branch
     * @param string $file
     * @return \Illuminate\Database\Eloquent\Model|Docs
     */
    private function getDocsModel(string $org, string $repo, string $branch, string $file)
    {
        return Docs::query()
            ->firstOrNew([
                'github_org'    => $org,
                'github_repo'   => $repo,
                'github_branch' => $branch,
                'github_file'   => $file,
            ]);
    }
}
