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
use App\Http\Middleware\CurrentPageState;
use Illuminate\Contracts\Session\Session;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /** @var string */
    protected $redirectTo;

    public function __construct(Session $session)
    {
        $this->redirectTo = $session->get(CurrentPageState::PAGE_NAME, '/');
    }

    public function index(): View
    {
        return view('page.auth.login');
    }
}
