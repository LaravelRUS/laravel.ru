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
use App\Http\Requests\RegistrationRequest;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

/**
 * Class RegistrationController
 *
 * @package App\Http\Controllers\Auth
 */
class RegistrationController extends Controller
{
    /**
     * RegistrationController constructor.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * @param  Factory  $factory
     *
     * @return View
     */
    public function index(Factory $factory): View
    {
        return $factory->make('page.auth.registration');
    }

    /**
     * @param  RegistrationRequest  $request
     * @param  Guard|StatefulGuard  $guard
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(RegistrationRequest $request, Guard $guard)
    {
        $user = User::create($request->only('name', 'email', 'password'));

        $guard->login($user, true);

        return redirect()->route('home');
    }
}
