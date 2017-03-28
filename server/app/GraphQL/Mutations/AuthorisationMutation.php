<?php
/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types = 1);

namespace App\GraphQL\Mutations;


use App\GraphQL\Types\AuthType;
use App\Models\User;
use App\Services\TokenAuth;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Encryption\Encrypter;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\JWTAuth;

class AuthorisationMutation extends AbstractMutation
{

    protected $attributes = [
        'name' => 'authorization'
    ];
    /**
     * @var Guard
     */
    private $jwt;

    /**
     * @var Encrypter
     */
    private $encrypter;
    /**
     * @var TokenAuth
     */
    private $guard;

    public function __construct($attributes = [], TokenAuth $guard)
    {
        parent::__construct($attributes);
        $this->guard = $guard;
    }

    /**
     * @return ObjectType
     */
    public function type(): ObjectType
    {
        return \GraphQL::type(AuthType::getName());
    }

    /**
     * @return array
     */
    public function args():array
    {
        return [
            'login' => ['name' => 'login',
                'type' => Type::string()],
            'password' => ['name' => 'password',
                'type' => Type::string()]
        ];
    }

    /**
     * @return array
     */
    public function rules():array
    {
        return [
            'login' => ['required'],
            'password' => ['required']
        ];
    }

    /**
     * @return array
     */
    public function messages():array
    {
        return [
            'login.required' => 'Укажите логин',
            'password.required' => 'Укажите пароль'
        ];
    }

    /**
     * @param \Illuminate\Validation\Validator $validator
     * @param $args
     */
    public function afterValidation($validator, $args)
    {
        if (!empty($args['login'])) {
            $user = User::whereName($args['login'])->orWhere('email', $args['login'])->first();
            /**@var $user User */
            if (empty($user)) {
                $validator->errors()->add('login', 'Пользователя с таким логином не существует');
            } else {
                if (!empty($args['password'])) {
                    if (!Hash::check($args['password'], $user->password)) {
                        $validator->errors()->add('login', 'Связка логин и пароль не совпадают');
                    }
                }
            }
        }
    }

    /**
     * @param $root
     * @param $args
     * @return User|mixed
     */
    public function resolve($root, $args)
    {
        $user = User::whereName($args['login'])->orWhere('email', $args['login'])->first();
        $user->token = $this->guard->fromUser($user);
        return $user;
    }

}