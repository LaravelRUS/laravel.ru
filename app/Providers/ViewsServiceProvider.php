<?php

/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Providers;

use App\Views\Composers\AuthComposer;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\ServiceProvider;

/**
 * Class ViewsServiceProvider.
 */
class ViewsServiceProvider extends ServiceProvider
{
    /**
     * @var Factory
     */
    private $views;

    /**
     * @param Factory $viewFactory
     *
     * @return void
     */
    public function boot(Factory $viewFactory): void
    {
        $this->views = $viewFactory;

        $this->compose('*', AuthComposer::class);
    }

    /**
     * @param  array|string $views
     * @param  string $viewComposer
     */
    private function compose($views, string $viewComposer): void
    {
        $this->app->singleton($viewComposer);

        $this->views->composer($views, $viewComposer);
    }

    /**
     * @return void
     */
    public function register(): void
    {
        //
    }
}
