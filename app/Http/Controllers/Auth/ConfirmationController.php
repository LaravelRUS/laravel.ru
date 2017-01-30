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
use Illuminate\Contracts\Encryption\Encrypter;
use Illuminate\Contracts\Session\Session;
use Illuminate\Contracts\View\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

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
     * @param  string     $id
     * @param  string     $token
     * @param  Encrypter  $crypt
     *
     * @return View
     *
     * @throws \LogicException
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     * @throws \Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException
     */
    public function confirm(string $id, string $token, Encrypter $crypt)
    {
        $user = User::find($id);

        if (!$user) {
            throw new NotFoundHttpException('User with target id not found');
        }

        if ((int)$user->email !== (int)$crypt->decrypt($token)) {
            throw new UnprocessableEntityHttpException('Invalid confirmation token');
        }

        if ($user->is_confirmed) {
            throw new \LogicException('User\'s e-mail already confirmed');
        }

        $user->is_confirmed = true;
        $user->save();

        return redirect()
            ->route('confirmation.confirmed')
            ->with('user', $user);
    }
}
