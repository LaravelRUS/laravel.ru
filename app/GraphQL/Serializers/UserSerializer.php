<?php declare(strict_types = 1);
/**
 * This file is part of laravel.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace App\GraphQL\Serializers;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserSerializer
 *
 * @package App\GraphQL\Serializers
 */
class UserSerializer extends AbstractSerializer
{
    /**
     * @param User|Model $user
     * @return array
     */
    public function toArray(Model $user): array
    {
        return [
            'id'           => $user->id,
            'name'         => $user->name,
            'email'        => $user->email,
            'avatar'       => $user->avatar,
            'is_confirmed' => $user->is_confirmed,
        ];
    }
}
