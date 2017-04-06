<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\Services\TokenAuth;
use Illuminate\Support\Arr;
use GraphQL\Type\Definition\Type;
use App\GraphQL\Types\AuthUserType;
use Illuminate\Contracts\Auth\Guard;
use GraphQL\Type\Definition\ObjectType;
use Illuminate\Contracts\Auth\StatefulGuard;
use App\GraphQL\Serializers\AuthUserSerializer;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

/**
 * Class AuthMutation.
 */
class AuthQuery extends AbstractQuery
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
     * @var StatefulGuard|Guard
     */
    private $guard;

    /**
     * AuthMutation constructor.
     * @param Guard $guard
     * @param TokenAuth $tokenAuth
     */
    public function __construct(Guard $guard, TokenAuth $tokenAuth)
    {
        parent::__construct([]);

        $this->tokenAuth = $tokenAuth;
        $this->guard = $guard;
    }

    /**
     * @return ObjectType
     */
    public function type(): ObjectType
    {
        return \GraphQL::type('AuthUser');
    }

    /**
     * @return array
     */
    public function queryArguments(): array
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
