<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class DocsCategory.
 */
class DocsCategory extends Model
{
    /**
     * @var string
     */
    protected $table = 'docs_categories';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return HasMany
     */
    public function docs(): HasMany
    {
        return $this->hasMany(Docs::class);
    }
}
