<?php declare(strict_types=1);
/**
 * This file is part of laravel.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Providers;

use App\Views\Composers\AuthComposer;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\ServiceProvider;

/**
 * Class ViewsServiceProvider
 * @package App\Providers
 */
class ViewsServiceProvider extends ServiceProvider
{
    /**
     * @var Factory
     */
    private $views;

    public function boot(): void
    {
        $this->views = $this->app->make(Factory::class);

        $this->compose('*', AuthComposer::class);
    }

    public function register(): void
    {
        //
    }

    /**
     * @param array|string $views
     * @param string $viewComposer
     */
    private function compose($views, string $viewComposer): void
    {
        $this->app->singleton($viewComposer);

        $this->views->composer($views, $viewComposer);
    }
}
