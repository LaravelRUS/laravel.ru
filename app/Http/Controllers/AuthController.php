<?php declare(strict_types=1);
/**
 * This file is part of laravel.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace App\Http\Controllers;

use App\Http\Middleware\CurrentPageState;
use Illuminate\Contracts\Session\Session;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

/**
 * Class AuthController
 * @package App\Http\Controllers
 */
class AuthController extends Controller
{
    use AuthenticatesUsers;

    /**
     * @var string
     */
    protected $redirectTo;

    /**
     * AuthController constructor.
     * @param Session $session
     */
    public function __construct(Session $session)
    {
        $this->redirectTo = $session->get(CurrentPageState::PAGE_NAME, '/');
    }

    /**
     * @return View
     */
    public function index(): View
    {
        return view('page.login');
    }
}