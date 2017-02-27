<?php

/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Docs;
use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use App\Services\GitHub\DocsStatus;
use App\Services\GitHub\DocsCollection;
use App\Services\GitHub\ExternalDocsPage;
use App\Services\GitHub\GitHubDocsManager;
use App\Services\GitHub\GitHubConfigRepository;

/**
 * Class GitHubDocsImport.
 */
class GitHubDocsImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'docs:import {?--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import documentation from GitHub.';

    /**
     * Execute the console command.
     *
     * @param  GitHubDocsManager                          $manager
     * @param  GitHubConfigRepository                     $config
     * @return void
     * @throws \Github\Exception\ErrorException
     * @throws \Github\Exception\InvalidArgumentException
     * @throws \RuntimeException
     */
    public function handle(GitHubDocsManager $manager, GitHubConfigRepository $config): void
    {
        $exists = $this->getDocsCurrentState(...$config->values());

        $files = $this->getFilesForSync($manager, $config, $exists);

        if (count($files) === 0) {
            $this->info('Skipping: Documentation are actual.');
        } else {
            $this->info('Found ' . count($files) . ' new pages.');
            $this->info('Start sync progress...');

            $this->output->progressStart(count($files));

            $this->sync($files, $manager, $config);

            $this->output->progressFinish();
        }

        $this->info('Completed');
        $this->output->newLine();
    }

    /**
     * @param  string     $org
     * @param  string     $repo
     * @param  string     $branch
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
     * @param  GitHubDocsManager                          $manager
     * @param  GitHubConfigRepository                     $config
     * @param  Collection                                 $exists
     * @return Collection|DocsCollection
     * @throws \Github\Exception\ErrorException
     * @throws \Github\Exception\InvalidArgumentException
     * @throws \RuntimeException
     */
    private function getFilesForSync(GitHubDocsManager $manager, GitHubConfigRepository $config, Collection $exists)
    {
        $isForce = $this->option('force');

        return $manager->findFiles(...$config->values())
            // Remove not updated docs
            ->reject(function (DocsStatus $status) use ($exists, $isForce) {
                if ($isForce) {
                    return false;
                }

                return $exists->where('github_hash', $status->getHash())->first();
            });
    }

    /**
     * @param  DocsCollection                             $files
     * @param  GitHubDocsManager                          $manager
     * @param  GitHubConfigRepository                     $config
     * @throws \Github\Exception\ErrorException
     * @throws \Github\Exception\InvalidArgumentException
     */
    private function sync(DocsCollection $files, GitHubDocsManager $manager, GitHubConfigRepository $config): void
    {
        /** @var DocsStatus $status */
        foreach ($files as $status) {
            $args = $config->values();
            $args[] = $status->getPath();

            /** @var ExternalDocsPage $page */
            $page = $manager->import(...$args);

            $docs = $this->getDocsModel(...$args);

            $docs->content_source = $page->getContent();
            $docs->github_hash = $status->getHash();

            if (! $docs->category_id) {
                $docs->category_id = 0; // TODO
            }

            if (! $docs->title) {
                $docs->title = Str::ucfirst(str_replace(
                    ['-', '_'],
                    ' ',
                    $page->getUrl()
                ));
            }

            $docs->save();

            $this->output->progressAdvance();
            $this->output->write(sprintf(' <info>Synchronizing "%s" page</info>', $docs->title));
        }
    }

    /**
     * @param  string                                   $org
     * @param  string                                   $repo
     * @param  string                                   $branch
     * @param  string                                   $file
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
