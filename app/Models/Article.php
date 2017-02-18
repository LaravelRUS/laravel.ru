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
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    protected $dates = [
        self::PUBLISHED_AT,
    ];

    protected $table = 'articles';

    protected $fillable = [
        'user_id',
        'title',
        'image',
        'content_source',
        'status',
        'published_at',
    ];

    public function getImageUrlAttribute(): string
    {
        return static::DEFAULT_IMAGE_PATH.$this->image;
    }

    public function getCapitalizeTitleAttribute(): string
    {
        return Str::ucfirst($this->title);
    }

    public function getNicePublishedDateAttribute(): string
    {
        if ($this->published_at > Carbon::now()->subMonth()) {
            return $this->published_at->diffForHumans();
        }

        return $this->published_at->toDateTimeString();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'article_tags');
    }

    public static function scopeLatestPublished(Builder $builder): Builder
    {
        return $builder
            ->with('user')
            ->with('tags')
            ->latest()
            ->published();
    }

    public static function scopeLatest(Builder $builder): Builder
    {
        return $builder->orderBy('published_at', 'desc');
    }

    public static function scopePublished(Builder $builder): Builder
    {
        return $builder
            ->where('published_at', '<=', Carbon::now())
            ->where('status', Article\Status::PUBLISHED);
    }
}
