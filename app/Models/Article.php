<?php

/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Article.
 */
class Article extends Model
{
    /**
     * Published date and time field name.
     */
    private const PUBLISHED_AT = 'published_at';

    /**
     * Directory of article images.
     */
    public const DEFAULT_IMAGE_PATH = '/static/articles/';

    /**
     * @var array
     */
    protected $dates = [
        self::PUBLISHED_AT,
    ];

    /**
     * @var string
     */
    protected $table = 'articles';

    /**
     * @var array
     */
    protected $fillable = [
        'user_id', 'title', 'image', 'content_source',
        'status', 'published_at',
    ];

    /**
     * @param  Builder $builder
     * @return Builder
     */
    public static function scopeLatestPublished(Builder $builder): Builder
    {
        return $builder
            ->with('user')
            ->with('tags')
            ->latest()
            ->published();
    }

    /**
     * @param  Builder $builder
     * @return Builder
     */
    public static function scopeLatest(Builder $builder): Builder
    {
        return $builder->orderBy('published_at', 'desc');
    }

    /**
     * @param  Builder $builder
     * @return Builder
     */
    public static function scopePublished(Builder $builder): Builder
    {
        return $builder
            ->where('published_at', '<=', Carbon::now())
            ->where('status', Article\Status::PUBLISHED);
    }

    /**
     * @param  Authenticatable|User|null $user
     * @return bool
     */
    public function isAllowedForUser(?Authenticatable $user): bool
    {
        $isAuthor = $user === null ? false : ($this->user->id === $user->getAuthIdentifier());

        $isPublished = $this->status === Article\Status::PUBLISHED;

        $isAllowPublishedTime = $this->published_at <= Carbon::now();

        return $isAuthor || ($isPublished && $isAllowPublishedTime);
    }

    /**
     * @return string
     */
    public function getImageUrlAttribute(): string
    {
        return static::DEFAULT_IMAGE_PATH . $this->image;
    }

    /**
     * @return string
     */
    public function getCapitalizeTitleAttribute(): string
    {
        return Str::ucfirst($this->title);
    }

    /**
     * @return string
     */
    public function getNicePublishedDateAttribute(): string
    {
        if ($this->published_at > Carbon::now()->subMonth()) {
            return $this->published_at->diffForHumans();
        }

        return $this->published_at->toDateTimeString();
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsToMany
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'article_tags');
    }
}
