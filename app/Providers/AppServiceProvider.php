<?php

/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Providers;

use App\GraphQL\Kernel\EnumTransfer;
use Carbon\Carbon;
use App\Services\ColorGenerator;
use GuzzleHttp\Client as Guzzle;
use Illuminate\Config\Repository;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use GuzzleHttp\ClientInterface as GuzzleInterface;

/**
 * Class AppServiceProvider.
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * @var Application
     */
    protected $app;

    public function register(): void
    {
        $this->localizeCarbon();
        $this->loadLocalProviders();
        $this->registerGuzzleClient();

        $this->app->singleton(ColorGenerator::class);
        $this->app->singleton(EnumTransfer::class);
    }

    private function localizeCarbon(): void
    {
        $locale = $this->app->make(Repository::class)->get('app.locale');

        Carbon::setLocale($locale);
    }

    private function loadLocalProviders(): void
    {
        if ($this->app->isLocal()) {
            array_map(
                [$this->app, 'register'],
                config('app.local_providers', [])
            );
        }
    }

    private function registerGuzzleClient(): void
    {
        $this->app->singleton(Guzzle::class, function () {
            return new Guzzle();
        });

        $this->app->alias(Guzzle::class, GuzzleInterface::class);
    }
}
