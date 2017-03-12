<?php
/**
 * This file is part of laravel.ru package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Service\SearchService;

use Illuminate\Support\ServiceProvider;

/**
 * Class SearchServiceProvider
 * @package Service\SearchService
 */
class SearchServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(SearchRepositoryInterface::class, SearchWithLike::class);
    }
}