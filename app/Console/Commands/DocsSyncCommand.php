<?php
/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\DocsPage;
use App\Models\DocsVersions;
use Illuminate\Console\Command;
use Service\DocsImporter\DocsFileInterface;
use Service\DocsImporter\DocsImporterManager;

/**
 * Class DocsSyncCommand
 *
 * @package App\Console\Commands
 */
class DocsSyncCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'docs:sync {?--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync documentation from GitHub or other resources.';

    /**
     * Execute the console command.
     *
     * @param DocsImporterManager $manager
     * @return void
     * @throws \Symfony\Component\Console\Exception\InvalidArgumentException
     */
    public function handle(DocsImporterManager $manager): void
    {
        $isForce = $this->option('force');
        $docs = DocsVersions::with('pages')->get();

        if ($docs->isEmpty()) {
            $this->line('Skipping: <info>No docs provided.</info>');

            return;
        }

        /** @var DocsVersions $repo */
        foreach ($docs as $repo) {
            $importer = $manager->get($repo->importer);
            $config = $importer->config($repo->importer_config);

            foreach ($importer->files($config) as $file) {
                $this->line(
                    ' ' . $repo->project->title .
                    ' [ ' . $repo->version . ' ] ' .
                    ' <fg=black;bg=white> ' . $file->getRoute() . ' </>:'
                );

                /*
                |--------------------------------------------------------------------------
                | Is file with required hash exists?
                |--------------------------------------------------------------------------
                */
                $updateRequired = $repo->pages->where('hash', $file->getHash())->isEmpty();

                if (! $updateRequired) {
                    $this->line('   <comment>The file was not updated.</comment>');

                    if (! $isForce) {
                        $this->line('   <comment>Ignore synchronization.</comment>');
                        continue;
                    }

                    $this->line('   <comment>Force update.</comment>');
                }

                /*
                |--------------------------------------------------------------------------
                | Is file with required identifier exists?
                |--------------------------------------------------------------------------
                */
                $page = $repo->pages->where('identify', $file->getId())->first();

                $message = '   <info>Found changes, update local record.</info>';

                if ($page === null) {
                    $message = '   <info>Local record not found, create a new one</info>';
                    $page = new DocsPage(['identify' => $file->getId()]);
                }

                $this->line($message);
                $this->updatePage($repo, $page, $file);
            }
        }
    }

    /**
     * @param DocsVersions $repo
     * @param DocsPage $page
     * @param DocsFileInterface $file
     */
    private function updatePage(DocsVersions $repo, DocsPage $page, DocsFileInterface $file)
    {
        $page->version()->associate($repo);

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
