<?php

/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Models;

use App\Models\User\GravatarSupport;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Service\ImageUploader\Resolvers\GravatarSupports;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User.
 */
class User extends Authenticatable implements GravatarSupports
{
    use Notifiable;
    use GravatarSupport;

    public const DEFAULT_AVATAR_PATH = '/static/avatars/';
    public const DEFAULT_AVATAR_NAME = 'default/1.png';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * @return User
     */
    public static function guest(): User
    {
        return new self(['id' => 0, 'name' => 'Guest']);
    }

    /**
     * @param  string $password
     * @return User
     */
    public function setPasswordAttribute(string $password): User
    {
        $this->attributes['password'] = bcrypt($password);

        return $this;
    }

    /**
     * @param  string|null $avatar
     * @return string
     */
    public function getAvatarAttribute(string $avatar = null): string
    {
        if ($avatar === null) {
            $avatar = self::DEFAULT_AVATAR_NAME;
        }

        return self::DEFAULT_AVATAR_PATH . $avatar;
    }

    /**
     * @return bool
     */
    public function hasAvatar(): bool
    {
        return (bool) ($this->original['avatar'] ?? false);
    }

    /**
     * @return MorphMany
     */
    public function articles(): MorphMany
    {
        return $this->morphMany(Article::class, 'user');
    }
}
