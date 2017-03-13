<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Service\SearchService;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\Container\Container;

/**
 * Class SearchServiceProvider
 * @package Service\SearchService
 */
class SearchServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register(): void
    {
        $this->resolveConfig();

        $this->app->singleton(SearchService::class, function (Container $app) {
            $service = new SearchService();

            $repositories  = (array)$app->make(Repository::class)
                ->get('search.repositories', []);

            foreach ($repositories as $repo) {
                $service->register($app->make($repo));
            }

            return $service;
        });
    }

    /**
     * @return void
     */
    private function resolveConfig(): void
    {
        $config = __DIR__ . '/../config/search.php';

        // Publish config
        $this->publishes([$config => config_path('search.php')]);

        // Merge default config
        $this->mergeConfigFrom($config, 'search');
    }
}