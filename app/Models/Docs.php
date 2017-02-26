<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;

/**
 * Class Docs.
 */
class Docs extends Model
{
    /**
     * @var string
     */
    protected $table = 'docs';

    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'content_source',
        'priority',
        // Github
        'github_org',
        'github_repo',
        'github_branch',
        'github_file',
        'github_hash',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'nav' => 'collection'
    ];

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(DocsCategory::class);
    }

    /**
     * @param array ...$level
     * @return Collection
     */
    public function getNav(...$level): Collection
    {
        return $this->nav->whereIn('level', $level)
            ->map(function (array $data) {
                return (object) $data;
            });
    }
}
