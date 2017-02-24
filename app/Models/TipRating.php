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
 * Class TipRating
 * @package App\Models
 */
class TipRating extends Model
{
    /**
     * @var string
     */
    protected $table = 'tips_rating';

    /**
     * @return BelongsTo
     */
    public function tip(): BelongsTo
    {
        return $this->belongsTo(Tip::class);
    }
}