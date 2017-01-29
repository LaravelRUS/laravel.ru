<?php declare(strict_types=1);
/**
 * This file is part of laravel.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use Illuminate\Contracts\View\View;

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
     */
    public function register(RegistrationRequest $request)
    {
        dd($request->all());
    }
}