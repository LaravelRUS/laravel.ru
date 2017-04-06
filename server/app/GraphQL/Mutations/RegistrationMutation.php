<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\User;
use Illuminate\Support\Arr;
use GraphQL\Type\Definition\Type;
use App\GraphQL\Types\AuthUserType;
use App\GraphQL\Serializers\UserSerializer;

/**
 * Class RegistrationMutation.
 */
class RegistrationMutation extends AbstractMutation
{
    /**
     * @var array
     */
    protected $attributes = [
        'name' => 'register',
    ];

    /**
     * @return array
     */
    public function args()
    {
        return [
            'name'                  => [
                'type'        => Type::nonNull(Type::string()),
                'description' => 'User name',
            ],
            'email'                 => [
                'type'        => Type::nonNull(Type::string()),
                'description' => 'User email',
            ],
            'password'              => [
                'type'        => Type::nonNull(Type::string()),
                'description' => 'User password',
            ],
            'password_confirmation' => [
                'type'        => Type::nonNull(Type::string()),
                'description' => 'User password confirmation',
            ],
        ];
    }

    /**
     * @return \GraphQL\Type\Definition\ObjectType|mixed|null
     */
    public function type()
    {
        return \GraphQL::type('AuthUser');
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => [
                'min:2',
                'unique:users,name',
            ],
            'email' => [
                'email',
                'unique:users,email',
            ],
            'password' => [
                'min:2',
                'max:100',
                'confirmed',
            ],
        ];
    }

    /**
     * @param $root
     * @param $args
     * @return array
     */
    public function resolve($root, $args)
    {
        $user = User::create(Arr::only($args, ['name', 'email', 'password']));

        return UserSerializer::serialize($user);
    }
}
