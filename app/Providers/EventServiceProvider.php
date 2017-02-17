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
use App\Models\Tag;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /** @var array */
    protected $listen = [];

    public function boot(): void
    {
        User::observe(User\AvatarUploaderObserver::class);
        User::observe(User\EmailConfirmationObserver::class);

        Article::observe(Article\ContentObserver::class);
        Article::observe(Article\SlugObserver::class);
        Article::observe(Article\PublishedDateObserver::class);

        Tag::observe(Tag\ColorObserver::class);

        parent::boot();
    }
}
