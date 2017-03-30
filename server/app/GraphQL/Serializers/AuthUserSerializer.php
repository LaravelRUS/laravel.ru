<?php

/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\GraphQL\Serializers;

use App\Models\User;
use App\Services\TokenAuth;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AuthUserSerializer.
 */
class AuthUserSerializer extends UserSerializer
{
    /**
     * @var TokenAuth
     */
    private $tokenAuth;

    /**
     * AuthUserSerializer constructor.
     * @param TokenAuth $tokenAuth
     */
    public function __construct(TokenAuth $tokenAuth)
    {
        $this->tokenAuth = $tokenAuth;
    }

    /**
     * @param  User|Model $user
     * @return array
     */
    public function toArray($user): array
    {
        return array_merge(parent::toArray($user), [
            'token' => $this->tokenAuth->fromUser($user),
        ]);
    }
}
