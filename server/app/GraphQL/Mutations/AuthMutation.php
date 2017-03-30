<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\GraphQL\Serializers\AuthUserSerializer;
use App\Services\TokenAuth;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Support\Arr;
use GraphQL\Type\Definition\Type;
use App\GraphQL\Types\AuthUserType;
use GraphQL\Type\Definition\ObjectType;
use App\GraphQL\Serializers\UserSerializer;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

/**
 * Class AuthMutation
 * @package App\GraphQL\Mutations
 */
class AuthMutation extends AbstractMutation
{
    /**
     * @var array
     */
    protected $attributes = [
        'name' => 'auth',
    ];

    /**
     * @var TokenAuth
     */
    private $tokenAuth;

    /**
     * @var StatefulGuard
     */
    private $guard;

    /**
     * AuthMutation constructor.
     * @param array $attributes
     * @param StatefulGuard $guard
     * @param TokenAuth $tokenAuth
     */
    public function __construct(array $attributes = [], StatefulGuard $guard, TokenAuth $tokenAuth)
    {
        parent::__construct($attributes);

        $this->tokenAuth = $tokenAuth;
        $this->guard = $guard;
    }

    /**
     * @return ObjectType
     */
    public function type(): ObjectType
    {
        return \GraphQL::type(AuthUserType::getName());
    }

    /**
     * @return array
     */
    public function args(): array
    {
        return [
            'email'    => [
                'name' => 'email',
                'type' => Type::nonNull(Type::string()),
            ],
            'password' => [
                'name' => 'password',
                'type' => Type::nonNull(Type::string()),
            ],
            'remember' => [
                'name' => 'remember',
                'type' => Type::boolean(),
            ],
        ];
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => [
                'email',
                'exists:users,email',
            ],
        ];
    }

    /**
     * @param $root
     * @param array $args
     * @return array
     * @throws AccessDeniedHttpException
     */
    public function resolve($root, $args)
    {
        [$email, $password] = $this->getEmailAndPassword($args);

        $user = $this->tokenAuth->attemptFromEmailAndPassword($email, $password);

        if (! $user) {
            throw new AccessDeniedHttpException('User password are not correct');
        }

        if (isset($args['remember'])) {
            $this->guard->login($user, (bool)$args['remember']);
        }

        return AuthUserSerializer::serialize($user);
    }

    /**
     * @param array $args
     * @return array
     */
    private function getEmailAndPassword(array $args = []): array
    {
        return [
            Arr::get($args, 'email', ''),
            Arr::get($args, 'password', ''),
        ];
    }
}