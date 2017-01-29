<?php declare(strict_types=1);
/**
 * This file is part of laravel.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use App\Http\Requests\RegistrationRequest;

/**
 * Class RegistrationController
 * @package App\Http\Controllers
 */
class RegistrationController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        return view('page.register');
    }

    /**
     * @param RegistrationRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(RegistrationRequest $request)
    {
        $user = User::create($request->only('name', 'email', 'password'));

        // TODO: Remove this and change to DI
        \Auth::login($user);

        return redirect()->route('home');
    }
}