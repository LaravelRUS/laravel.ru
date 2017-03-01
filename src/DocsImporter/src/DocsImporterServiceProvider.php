<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Service\DocsImporter;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Container\Container;
use GrahamCampbell\GitHub\GitHubServiceProvider;

/**
 * Class DocsImporterServiceProvider.
 */
class DocsImporterServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register(): void
    {
        $this->registerGitHubProvider();

        $this->app->singleton(DocsImporterManager::class, function (Container $app) {
            return new DocsImporterManager($app);
        });
    }

    /**
     * @return void
     */
    private function registerGitHubProvider(): void
    {
        $this->app->register(GitHubServiceProvider::class);
    }
}