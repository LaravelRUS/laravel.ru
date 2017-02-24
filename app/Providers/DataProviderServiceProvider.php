<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Providers;

use App\Services\DataProviders\Manager;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

/**
 * Class DataProviderServiceProvider.
 */
class DataProviderServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(Manager::class, function (Application $app) {
            $config = $app->make(Repository::class);
            $providers = (array)$config->get('data-providers.providers', []);

            return new Manager($providers, $app);
        });
    }
}