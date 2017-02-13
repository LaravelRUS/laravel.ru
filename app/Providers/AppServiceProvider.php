<?php declare(strict_types=1);
/**
 * This file is part of laravel.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Providers;

use App\Services\ColorGenerator;
use Carbon\Carbon;
use GuzzleHttp\Client as Guzzle;
use GuzzleHttp\ClientInterface as GuzzleInterface;
use Illuminate\Config\Repository;
use Illuminate\Support\ServiceProvider;

/**
 * Class AppServiceProvider
 * @package App\Providers
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->localizeCarbon();
        $this->loadLocalProviders();
        $this->registerGuzzleClient();

        $this->app->singleton(ColorGenerator::class);
    }

    /**
     * @return void
     */
    private function localizeCarbon(): void
    {
        $locale = $this->app->make(Repository::class)->get('app.locale');

        Carbon::setLocale($locale);
    }

    /**
     * @return void
     */
    private function registerGuzzleClient(): void
    {
        $this->app->singleton(Guzzle::class, function () {
            return new Guzzle([

            ]);
        });

        $this->app->alias(Guzzle::class, GuzzleInterface::class);
    }

    /**
     * @return void
     */
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
