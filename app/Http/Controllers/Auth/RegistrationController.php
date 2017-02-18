<?php

/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class RegistrationController extends Controller
{
    public function index(Factory $factory): View
    {
        return $factory->make('page.auth.registration');
    }

    public function register(RegistrationRequest $request, Guard $guard): RedirectResponse
    {
        $user = User::create($request->only('name', 'email', 'password'));

        /* @var StatefulGuard $guard */
        $guard->login($user, true);

        return redirect()->route('home');
    }
}
