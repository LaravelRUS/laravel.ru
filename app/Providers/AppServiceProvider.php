<?php

/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Providers;

use Illuminate\Config\Repository;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

/**
 * Class AppServiceProvider.
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * @var Application
     */
    protected $app;

    /**
     * @retrun void
     * @throws \InvalidArgumentException?query=is%3Aresolved
     */
    public function register(): void
    {
        $this->loadLocalProviders($this->app->make(Repository::class));
        $this->loadProductionProviders($this->app->make(Repository::class));
    }

    /**
     * @param  Repository $repository
     * @return void
     */
    private function loadProductionProviders(Repository $repository): void
    {
        if (! $this->app->isLocal()) {
            $providers = (array) $repository->get('app.production_providers', []);

            foreach ($providers as $provider) {
                $this->app->register($provider);
            }
        }
    }

    /**
     * @param  Repository $repository
     * @return void
     */
    private function loadLocalProviders(Repository $repository): void
    {
        if ($this->app->isLocal()) {
            $providers = (array) $repository->get('app.local_providers', []);

            foreach ($providers as $provider) {
                $this->app->register($provider);
            }
        }
    }
}
