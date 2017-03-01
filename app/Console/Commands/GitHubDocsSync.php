<?php

/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Docs;
use App\Models\DocsPage;
use Illuminate\Console\Command;
use Service\DocsImporter\DocsFileInterface;
use Service\DocsImporter\DocsImporterManager;

/**
 * Class GitHubDocsSync.
 */
class GitHubDocsSync extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'docs:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync documentation from GitHub.';

    /**
     * Execute the console command.
     * @param  DocsImporterManager $manager
     * @return void
     */
    public function handle(DocsImporterManager $manager): void
    {
        $docs = Docs::with('pages')->get();

        if ($docs->isEmpty()) {
            $this->info('Skipping: No docs provided.');

            return;
        }

        /** @var Docs $repo */
        foreach ($docs as $repo) {
            $importer = $manager->get($repo->importer);
            $config = $importer->config($repo->importer_config);

            foreach ($importer->files($config) as $file) {
                $prefix = '[' . $repo->title . ']::' . $file->getRoute();

                /*
                |--------------------------------------------------------------------------
                | Is file with required hash exists?
                |--------------------------------------------------------------------------
                */
                $updateRequired = $repo->pages->where('hash', $file->getHash())->isEmpty();

                if (! $updateRequired) {
                    $this->comment($prefix . ' has no available updates.');
                    continue;
                }

                /*
                |--------------------------------------------------------------------------
                | Is file with required identifier exists?
                |--------------------------------------------------------------------------
                */
                $page = $repo->pages->where('identify', $file->getId())->first();

                $message = $prefix . ' found. Updating sources...';

                if ($page === null) {
                    $message = $prefix . ' not exists. Uploading new...';
                    $page = new DocsPage(['identify' => $file->getId()]);
                }

                $this->comment($message);
                $this->updatePage($repo, $page, $file);
            }
        }
    }

    /**
     * @param Docs              $repo
     * @param DocsPage          $page
     * @param DocsFileInterface $file
     */
    private function updatePage(Docs $repo, DocsPage $page, DocsFileInterface $file)
    {
        $page->docs()->associate($repo);

        if ($page->category_id === null) {
            $page->category_id = 0;
        }

        $page->slug = $file->getRoute();
        $page->hash = $file->getHash();
        $page->title = $file->getTitle();
        $page->content_source = $file->getContent();

        $page->save();
    }
}
