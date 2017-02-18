<?php

/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

/**
 * Class RouteServiceProvider.
 */
class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     */
    public function boot(): void
    {
        //

        parent::boot();
    }

    /**
     * @param Router $router
     */
    public function map(Router $router): void
    {
        $this->mapApiRoutes($router);

        $this->mapWebRoutes($router);
    }

    /**
     * @param Router $router
     */
    protected function mapApiRoutes(Router $router): void
    {
        $attributes = [
            'middleware' => 'api',
            'namespace'  => $this->namespace,
        ];

        $router->group($attributes, base_path('routes/api.php'));
    }

    /**
     * @param Router $router
     */
    protected function mapWebRoutes(Router $router): void
    {
        $attributes = [
            'middleware' => 'web',
            'namespace'  => $this->namespace,
        ];

        $router->group($attributes, base_path('routes/web.php'));
    }
}
