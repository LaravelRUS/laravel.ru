<?php

/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Providers;

use App\Models\Article;
use App\Services\TokenAuth;
use App\Policies\ArticlePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

/**
 * Class AuthServiceProvider.
 */
class AuthServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    protected $policies = [
        Article::class => ArticlePolicy::class,
    ];

    /**
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(TokenAuth::class);
    }

    /**
     * @return void
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
