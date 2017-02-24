<?php
/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Models;

use App\Models\Tip\RatingType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Tip
 * @package App\Models
 */
class Tip extends Model
{
    /**
     * @var string
     */
    protected $table = 'tips';

    /**
     * @return HasMany
     */
    public function rating(): HasMany
    {
        return $this->hasMany(TipRating::class);
    }

    /**
     * @return HasMany
     */
    public function likes(): HasMany
    {
        return $this->rating()->where('type', RatingType::LIKE);
    }

    /**
     * @return HasMany
     */
    public function dislikes(): HasMany
    {
        return $this->rating()->where('type', RatingType::DISLIKE);
    }
}