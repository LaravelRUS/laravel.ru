<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * Class Bot.
 */
class Bot extends Model
{
    private const DEFAULT_AVATAR_PATH = '/static/bots/';

    /**
     * @var string
     */
    protected $table = 'bots';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @param  string $avatar
     * @return string
     */
    public function getAvatarAttribute(string $avatar): string
    {
        return self::DEFAULT_AVATAR_PATH . $avatar;
    }

    /**
     * @return MorphMany
     */
    public function articles(): MorphMany
    {
        return $this->morphMany(Article::class, 'user');
    }
}
