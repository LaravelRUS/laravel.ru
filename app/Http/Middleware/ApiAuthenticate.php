<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Http\Middleware;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Contracts\Auth\Guard;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Contracts\Container\Container;
use Tymon\JWTAuth\Providers\JWT\JWTInterface;
use Illuminate\Contracts\Auth\Authenticatable;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class ApiAuthenticate.
 */
class ApiAuthenticate
{
    /**
     * @var Guard
     */
    private $auth;

    /**
     * @var JWTInterface
     */
    private $jwt;

    /**
     * @var Container
     */
    private $app;

    /**
     * ApiAuthenticate constructor.
     * @param Guard        $auth
     * @param JWTInterface $jwt
     * @param Container    $app
     */
    public function __construct(Guard $auth, JWTInterface $jwt, Container $app)
    {
        $this->auth = $auth;
        $this->jwt = $jwt;
        $this->app = $app;
    }

    /**
     * @param  Request                          $request
     * @param  \Closure                         $next
     * @return mixed
     * @throws BadRequestHttpException
     * @throws UnprocessableEntityHttpException
     */
    public function handle(Request $request, \Closure $next)
    {
        $user = $this->getUser($request);

        $this->app->instance(Authenticatable::class, $user);

        /** @var Response $response */
        return $next($request);
    }

    /**
     * @param  Request                          $request
     * @return Authenticatable|User
     * @throws BadRequestHttpException
     * @throws UnprocessableEntityHttpException
     */
    private function getUser(Request $request): Authenticatable
    {
        switch (true) {
            case $request->has('_token'):
                return $this->authByToken($request->get('_token', ''));

            case $request->headers->has('X-Api-Token'):
                return $this->authByToken($request->headers->get('X-Api-Token', ''));

            case $this->auth->check():
                return $this->auth->user();
        }

        return User::guest();
    }

    /**
     * @param  string                           $token
     * @return Authenticatable
     * @throws BadRequestHttpException
     * @throws UnprocessableEntityHttpException
     */
    private function authByToken(string $token): Authenticatable
    {
        try {
            $userInfo = $this->jwt->decode($token);
        } catch (TokenExpiredException $e) {
            throw new BadRequestHttpException('Token lifetime is timed out.');
        } catch (JWTException $invalidException) {
            throw new BadRequestHttpException('Broken api token.');
        }

        [$id, $password] = [
            Arr::get($userInfo, 'user.id'),
            Arr::get($userInfo, 'user.password'),
        ];

        if (User::guest()->id === $id) {
            return User::guest();
        }

        $user = User::where('id', $id)->where('password', $password)->first();

        if (! $user) {
            throw new UnprocessableEntityHttpException('Invalid user credentials.');
        }

        return $user;
    }
}
