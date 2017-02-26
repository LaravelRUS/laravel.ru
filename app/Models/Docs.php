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
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(DocsCategory::class);
    }
}
