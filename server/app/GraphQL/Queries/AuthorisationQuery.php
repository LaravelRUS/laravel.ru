<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\Models\User;
use App\Services\TokenAuth;
use Illuminate\Support\Arr;
use App\GraphQL\Types\UserType;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ObjectType;
use App\GraphQL\Serializers\UserSerializer;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Validation\Validator;

/**
 * Class AuthorisationQuery
 * @package App\GraphQL\Mutations
 */
class AuthorisationQuery extends AbstractQuery
{
    /**
     * @var array
     */
    protected $attributes = [
        'name' => 'authorization',
    ];

    /**
     * @var TokenAuth
     */
    private $tokenAuth;

    /**
     * AuthorisationQuery constructor.
     * @param array $attributes
     * @param TokenAuth $tokenAuth
     */
    public function __construct(array $attributes = [], TokenAuth $tokenAuth)
    {
        parent::__construct($attributes);

        $this->tokenAuth = $tokenAuth;
    }

    /**
     * @return ObjectType
     */
    public function type(): ObjectType
    {
        return \GraphQL::type(UserType::getName());
    }

    /**
     * @return array
     */
    public function queryArguments(): array
    {
        return [
            'email'    => [
                'name' => 'email',
                'type' => Type::string(),
            ],
            'password' => [
                'name' => 'password',
                'type' => Type::string(),
            ],
        ];
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'email'    => [
                'email',
                'exists:users,email',
            ]
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'email.required'    => 'Укажите email',
            'password.required' => 'Укажите пароль',
        ];
    }

    /**
     * @param Validator $validator
     * @param array $args
     * @return \Generator|null
     */
    public function validate(Validator $validator, array $args = []): ?\Generator
    {
        [$email, $password] = $this->getEmailAndPassword($args);

        if ($email && $password) {
            $user = $this->tokenAuth->attemptFromEmailAndPassword($email, $password);

            if ($user === null) {
                yield 'password' => 'Invalid user password';
            }
        }
    }

    /**
     * @param array $args
     * @return array
     */
    private function getEmailAndPassword(array $args = []): array
    {
        return [
            Arr::get($args, 'email'),
            Arr::get($args, 'password')
        ];
    }

    /**
     * @param $root
     * @param $args
     * @return array
     * @throws \Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException
     */
    public function resolve($root, $args)
    {
        $user = $this->getUser($args);
        $user->token = $this->tokenAuth->fromUser($user);

        return UserSerializer::serialize($user);
    }

    /**
     * @param array $args
     * @return User|Authenticatable
     */
    private function getUser(array $args): User
    {
        [$email, $password] = $this->getEmailAndPassword($args);

        if ($email && $password) {
            return $this->tokenAuth->attemptFromEmailAndPassword($email, $password);
        }

        return $this->tokenAuth->guest();
    }

}