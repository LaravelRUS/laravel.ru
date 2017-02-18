<?php

/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User.
 */
class User extends Authenticatable
{
    use Notifiable;

    public const DEFAULT_AVATAR_PATH = '/static/avatars/';
    public const DEFAULT_AVATAR_NAME = 'default/1.png';

    /**
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar',
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @param string $password
     *
     * @return User
     */
    public function setPasswordAttribute(string $password): User
    {
        $this->attributes['password'] = bcrypt($password);

        return $this;
    }

    /**
     * @param string|null $avatar
     *
     * @return string
     */
    public function getAvatarAttribute(string $avatar = null): string
    {
        if ($avatar === null) {
            $avatar = self::DEFAULT_AVATAR_NAME;
        }

        return self::DEFAULT_AVATAR_PATH.$avatar;
    }

    /**
     * @return bool
     */
    public function hasAvatar(): bool
    {
        return (bool) ($this->original['avatar'] ?? false);
    }
}
