<?php
/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types = 1);

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Config\Repository;
use Illuminate\Support\ServiceProvider;

/**
 * Class DateTimeServiceProvider.
 */
class DateTimeServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register(): void
    {
        Carbon::setLocale($this->getLocale());
    }

    /**
     * @return string
     */
    private function getLocale(): string
    {
        return $this->app->make(Repository::class)->get('app.locale');
    }
}
