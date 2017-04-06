<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Models;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class DocsPage.
 */
class DocsPage extends Model
{
    /**
     * @var string
     */
    protected $table = 'docs_pages';

    /**
     * @var array
     */
    protected $fillable = [
        'identify',
        'hash',
        'title',
        'title',
        'content_source',
        'priority',
        'nav',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'nav' => 'collection',
    ];

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(DocsCategory::class);
    }

    /**
     * @return BelongsTo
     */
    public function docs(): BelongsTo
    {
        return $this->belongsTo(Docs::class, 'docs_id', 'id', 'pages');
    }

    /**
     * @param  array      ...$level
     * @return Collection
     */
    public function getNav(...$level): Collection
    {
        return $this->nav->whereIn('level', $level)
            ->map(function (array $data) {
                return (object) $data;
            });
    }

    /**
     * @param  Builder $builder
     * @param  string  $version
     * @return Builder
     */
    public static function scopeWhereVersion(Builder $builder, string $version): Builder
    {
        return $builder->whereHas('docs', function (Builder $query) use ($version) {
            return $query->where('version', $version);
        });
    }
}
