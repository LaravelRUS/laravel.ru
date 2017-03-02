<?php

/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Providers;

use App\Models\Tip\ContentObserver;
use Illuminate\Config\Repository;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Service\ContentRenderer\ContentRendererInterface;
use Service\ContentRenderer\RenderersRepository;

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
     * @throws \InvalidArgumentException
     */
    public function register(): void
    {
        $this->loadLocalProviders($this->app->make(Repository::class));

        // Tips content renderer
        $this->app->when(ContentObserver::class)
              ->needs(ContentRendererInterface::class)
              ->give(function () {
                  return $this->app->make(RenderersRepository::class)
                       ->getRenderer('raw');
              });
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
