<?php declare(strict_types=1);
/**
 * This file is part of laravel.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

/**
 * Class Article
 * @package App\Models
 */
class Article extends Model
{
    /**
     * Published date and time field name
     */
    private const PUBLISHED_AT = 'published_at';

    /**
     * Directory of article images
     */
    public const DEFAULT_IMAGE_PATH = '/static/articles/';

    /**
     * @var array
     */
    protected $dates = [
        self::PUBLISHED_AT
    ];

    /**
     * @var string
     */
    protected $table = 'articles';

    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'title',
        'image',
        'content_source',
        'status',
        'published_at'
    ];

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

    /**
     * @param Builder $builder
     * @return Builder
     */
    public static function scopeLatest(Builder $builder): Builder
    {
        return $builder->orderBy('published_at', 'desc');
    }

    /**
     * @param Builder $builder
     * @return Builder
     */
    public static function scopePublished(Builder $builder): Builder
    {
        return $builder
            ->where('published_at', '<=', Carbon::now())
            ->where('status', Article\Status::PUBLISHED);
    }
}