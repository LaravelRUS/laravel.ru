<?php declare(strict_types=1);
/**
 * This file is part of laravel.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Contracts\Encryption\Encrypter;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Contracts\Session\Session;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\Auth\Guard;
use App\Http\Requests\RegistrationRequest;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class RegistrationController
 * @package App\Http\Controllers
 */
class RegistrationController extends Controller
{
    /**
     * @param Factory $factory
     * @return View
     */
    public function index(Factory $factory): View
    {
        return $factory->make('page.register');
    }

    /**
     * @param Session $session
     * @return View
     */
    public function confirmationIndex(Session $session)
    {
        if (!$session->has('user')) {
            return redirect()->route('home');
        }

        return view('page.confirmation', [
            'user' => $session->get('user'),
        ]);
    }

    /**
     * TODO Change encryption algo to JWT
     *
     * @param string $id
     * @param string $token
     * @param Encrypter $crypt
     * @return View
     * @throws \LogicException
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     * @throws \Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException
     */
    public function confirmation(string $id, string $token, Encrypter $crypt)
    {
        $user = User::find($id);

        if (!$user) {
            throw new NotFoundHttpException('User with target id not found');
        }

        if ((int)$user->email !== (int)$crypt->decrypt($token)) {
            throw new UnprocessableEntityHttpException('Invalid confirmation token');
        }

        if ($user->is_confirmed) {
            throw new \LogicException('User e-mail already confirmed');
        }

        $user->is_confirmed = true;
        $user->save();

        return redirect()
            ->route('registration.confirm')
            ->with('user', $user);
    }

    /**
     * @param RegistrationRequest $request
     * @param Guard|StatefulGuard $guard
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(RegistrationRequest $request, Guard $guard)
    {
        $user = User::create($request->only('name', 'email', 'password'));

        $guard->login($user, true);

        return redirect()->route('home');
    }
}