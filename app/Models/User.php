<?php declare(strict_types=1);
/**
 * This file is part of laravel.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 *
 */
class User extends Authenticatable
{
    use Notifiable;

    public const DEFAULT_AVATAR_PATH = '/static/avatars/';
    private const DEFAULT_AVATAR_NAME = 'default.png';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @param string $password
     * @return User
     */
    public function setPasswordAttribute(string $password): User
    {
        $this->attributes['password'] = bcrypt($password);

        return $this;
    }

    /**
     * @param string|null $avatar
     * @return string
     */
    public function getAvatarAttribute(string $avatar = null)
    {
        if ($avatar === null) {
            return static::getDefaultAvatar();
        }

        return self::DEFAULT_AVATAR_PATH . $avatar;
    }

    /**
     * @return string
     */
    public static function getDefaultAvatar(): string
    {
        return self::DEFAULT_AVATAR_PATH . self::DEFAULT_AVATAR_NAME;
    }

    /**
     * @return bool
     */
    public function hasAvatar(): bool
    {
        return (bool)($this->original['avatar'] ?? false);
    }
}
