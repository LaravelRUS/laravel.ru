<?php
/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types = 1);

namespace App\Providers;

use App\GraphQL\Kernel\EnumTransfer;
use Illuminate\Support\ServiceProvider;

/**
 * Class EnumsServiceProvider.
 */
class EnumsServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(EnumTransfer::class);
    }
}
