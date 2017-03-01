<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
     * @return HasMany
     */
    public function pages(): HasMany
    {
        return $this->hasMany(DocsPage::class);
    }

    /**
     * @param string $title
     * @return string
     */
    public function getTitleAttribute(string $title): string
    {
        return Str::ucfirst($title) . ' (' . $this->version . ')';
    }
}
