<?php

/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Arr;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Session\Session;
use Illuminate\Contracts\Auth\StatefulGuard;
use Tymon\JWTAuth\Providers\JWT\JWTInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class ConfirmationController.
 */
class ConfirmationController extends Controller
{
    /**
     * @param Session $session
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function index(Session $session)
    {
        if (! $session->has('user')) {
            return redirect()->route('home');
        }

        return view('page.auth.confirmed', [
            'user' => $session->get('user'),
        ]);
    }

    /**
     * @param string $token
     * @param JWTInterface $crypt
     * @param Guard $guard
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \LogicException
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function confirm(string $token, JWTInterface $crypt, Guard $guard)
    {
        $email = Arr::get($crypt->decode($token), 'email');

        /** @var User $user */
        $user = User::whereEmail($email)->first();

        if (! $user) {
            throw new NotFoundHttpException('User with target id not found');
        }

        if ($user->is_confirmed) {
            throw new \LogicException('User\'s e-mail already confirmed');
        }

        $user->is_confirmed = true;
        $user->save();

        /* @var StatefulGuard $guard */
        $guard->login($user, true);

        return redirect()
            ->route('confirmation.confirmed')
            ->with('user', $user);
    }
}
