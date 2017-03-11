<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Service\HeadersInjector;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\Container\Container;

/**
 * Class HeadersInjectorServiceProvider.
 */
class HeadersInjectorServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register(): void
    {
        $this->resolveConfig();

        $this->app->singleton(HeadersInjectorRepository::class, function (Container $app) {
            $config = $app->make(Repository::class)->get('headers-injector', []);

            return new HeadersInjectorRepository($app, $config);
        });
    }

    /**
     * @return void
     */
    public function boot(): void
    {
        /** @var Router $router */
        $router = $this->app->make(Router::class);

        $router->aliasMiddleware('headers', HeadersInjectorMiddleware::class);
    }

    /**
     * @return void
     */
    private function resolveConfig(): void
    {
        $config = __DIR__ . '/../config/headers-injector.php';

        // Publish config
        $this->publishes([$config => config_path('headers-injector.php')]);

        // Merge default config
        $this->mergeConfigFrom($config, 'headers-injector');
    }
}
