<?php
/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class DocsProjects
 * @package App\Models
 */
class DocsProject extends Model
{
    /**
     * @var string
     */
    protected $table = 'docs_projects';

    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'image',
        'description',
    ];

    /**
     * @return HasMany
     */
    public function versions(): HasMany
    {
        return $this->hasMany(DocsVersions::class, 'project_id', 'id');
    }
}
