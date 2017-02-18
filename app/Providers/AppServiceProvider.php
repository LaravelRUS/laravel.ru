<?php

/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Providers;

use App\Services\ColorGenerator;
use Carbon\Carbon;
use GuzzleHttp\Client as Guzzle;
use GuzzleHttp\ClientInterface as GuzzleInterface;
use Illuminate\Config\Repository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    public function register(): void
    {
        $this->localizeCarbon();
        $this->loadLocalProviders();
        $this->registerGuzzleClient();

        $this->app->singleton(ColorGenerator::class);
    }

    private function localizeCarbon(): void
    {
        $locale = $this->app->make(Repository::class)->get('app.locale');

        Carbon::setLocale($locale);
    }

    private function registerGuzzleClient(): void
    {
        $this->app->singleton(Guzzle::class, function () {
            return new Guzzle([

            ]);
        });

        $this->app->alias(Guzzle::class, GuzzleInterface::class);
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
}
