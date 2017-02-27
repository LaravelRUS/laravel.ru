<?php
/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types = 1);

namespace App\Providers;

use GuzzleHttp\Client as Guzzle;
use Illuminate\Support\ServiceProvider;
use GuzzleHttp\ClientInterface as GuzzleInterface;

/**
 * Class HttpClientServiceProvider.
 */
class HttpClientServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(Guzzle::class, function () {
            return new Guzzle();
        });

        $this->app->alias(Guzzle::class, GuzzleInterface::class);
    }
}
