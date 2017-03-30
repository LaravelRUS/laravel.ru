<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Encryption\Encrypter;
use Illuminate\Support\Arr;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Providers\JWT\JWTInterface;

/**
 * Class TokenAuth
 * @package App\Services
 */
class TokenAuth
{
    /**
     * @var JWTInterface
     */
    private $jwt;

    /**
     * @var Guard
     */
    private $guard;

    /**
     * TokenAuth constructor.
     * @param JWTInterface $jwt
     * @param Guard $guard
     */
    public function __construct(JWTInterface $jwt, Guard $guard)
    {
        $this->jwt = $jwt;
        $this->guard = $guard;
    }

    /**
     * @param string $email
     * @param string $password
     * @return Authenticatable
     */
    public function attemptFromEmailAndPassword(string $email, string $password): ?Authenticatable
    {
        if (! $this->guard->validate(['email' => $email, 'password' => $password])) {
            return null;
        }

        return User::whereEmail($email)->first();
    }

    /**
     * @param int $id
     * @param string $password
     * @return Authenticatable
     */
    public function resolveFromIdAndPassword(int $id, string $password): ?Authenticatable
    {
        if (! $this->guard->validate(['id' => $id, 'password' => $password])) {
            return null;
        }

        return User::find($id);
    }

    /**
     * @return Authenticatable
     */
    public function guest(): Authenticatable
    {
        return new User(['id' => 0, 'name' => 'Guest']);
    }

    /**
     * @param string $token
     * @return array
     */
    public function decode(string $token): array
    {
        return $this->jwt->decode($token);
    }

    /**
     * @param Guard $guard
     * @return string
     */
    public function fromGuard(Guard $guard): string
    {
        return $this->fromUser($guard->check() ? $guard->user() : $this->guest());
    }

    /**
     * @param Authenticatable $user
     * @return string
     */
    public function fromUser(Authenticatable $user): string
    {
        return $this->encode([
            'user'  => [
                'id'       => $user->getAuthIdentifier(),
                'password' => $user->getAuthPassword(),
            ],
            'token' => $user->getRememberToken(),
        ]);
    }

    /**
     * @param string $token
     * @return Authenticatable
     * @throws BadRequestHttpException
     * @throws UnprocessableEntityHttpException
     */
    public function fromToken(string $token): Authenticatable
    {
        try {
            $userInfo = $this->decode($token);
        } catch (TokenExpiredException $e) {
            throw new BadRequestHttpException('Token lifetime is timed out.');
        } catch (JWTException $invalidException) {
            throw new BadRequestHttpException('Broken api token.');
        }

        [$id, $password] = [
            (int)Arr::get($userInfo, 'user.id'),
            Arr::get($userInfo, 'user.password'),
        ];

        if ($id !== 0) {
            $user = User::where('id', $id)->where('password', $password)->first();

            if (! $user) {
                throw new UnprocessableEntityHttpException('Invalid user credentials.');
            }

            return $user;
        }

        return $this->guest();
    }

    /**
     * @param array $payload
     * @return string
     */
    public function encode(array $payload): string
    {
        return $this->jwt->encode($payload);
    }
}