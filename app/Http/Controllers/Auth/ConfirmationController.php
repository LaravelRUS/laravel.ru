<?php declare(strict_types=1);
/**
 * This file is part of laravel.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Session\Session;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use Tymon\JWTAuth\Providers\JWT\JWTInterface;

/**
 * Class ConfirmationController
 *
 * @package App\Http\Controllers\Auth
 */
class ConfirmationController extends Controller
{
    /**
     * @param  Session  $session
     *
     * @return View
     */
    public function index(Session $session)
    {
        if (!$session->has('user')) {
            return redirect()->route('home');
        }

        return view('page.auth.confirmed', [
            'user' => $session->get('user'),
        ]);
    }

    /**
     * TODO: Change encryption algo to JWT
     *
     * @param  string     $token
     * @param  JWTInterface  $crypt
     *
     * @return View
     *
     * @throws \LogicException
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     * @throws \Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException
     */
    public function confirm(string $token, JWTInterface $crypt)
    {
        $email = Arr::get($crypt->decode($token), 'email');

        /** @var User $user */
        $user = User::whereEmail($email)->first();

        if (!$user) {
            throw new NotFoundHttpException('User with target id not found');
        }

        if ($user->is_confirmed) {
            throw new \LogicException('User\'s e-mail already confirmed');
        }

        $user->is_confirmed = true;
        $user->save();

        \Auth::login($user, true);

        return redirect()
            ->route('confirmation.confirmed')
            ->with('user', $user);
    }
}
