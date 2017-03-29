<?php
/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types = 1);

namespace App\Services;


use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Encryption\Encrypter;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Providers\JWT\JWTInterface;

class TokenAuth
{
    /**
     * @var JWTInterface
     */
    private $jwt;
    /**
     * @var Encrypter
     */
    private $encrypter;
    /**
     * @var Guard
     */
    private $guard;

    public function __construct(JWTInterface $jwt, Encrypter $encrypter, Guard $guard)
    {

        $this->jwt = $jwt;
        $this->encrypter = $encrypter;
        $this->guard = $guard;
    }

    /**
     * @param string $token
     * @return bool
     */
    public function attempt(string $token) : bool
    {
        $credentials = $this->decode($token);
        if (!isset($credentials['id']) || !isset($credentials['password'])) {
            return false;
        }
        $exists = User::whereId($credentials['id'])->wherePassword($credentials['password'])->exists();
        if (!$exists) {
            return false;
        }
        $this->guard->onceUsingId($credentials['id']);
        return true;
    }

    /**
     * @param string $token
     * @throws TokenInvalidException
     * @throws DecryptException
     * @return array
     */
    public function decode(string $token) : array
    {
        $massive = $this->jwt->decode($token);
        foreach ($massive as &$item) {
            $item = $this->encrypter->decrypt($item);
        }
        return $massive;
    }

    /**
     * @return bool
     */
    public function check(): bool
    {
        return $this->guard->check();
    }

    /**
     * @return User
     */
    public function user() : User
    {
        return $this->guard->user();
    }

    /**
     * @return mixed
     */
    public function logout()
    {
        return $this->guard->logout();
    }

    /**
     * @param array $credentials
     * @return mixed
     */
    public function once(array $credentials)
    {
        return $this->guard->once($credentials);
    }

    /**
     * @param User $user
     * @return string
     */
    public function fromUser(User $user) : string
    {
        $credentials = ['id' => $user->id,
            'password' => $user->password,
            'create' => Carbon::now()->toRfc3339String()];
        return $this->encode($credentials);
    }

    /**
     * @param array $inputs
     * @return string
     */
    public function encode(array $inputs) : string
    {
        foreach ($inputs as &$item) {
            $item = $this->encrypter->encrypt($item);
        }
        return $this->jwt->encode($inputs);
    }
}