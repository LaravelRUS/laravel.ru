<?php

/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Article;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\Auth\Guard;
use Tymon\JWTAuth\Providers\JWT\JWTInterface;

/**
 * Class HomeController.
 */
class HomeController extends Controller
{
    /**
     * @return View
     */
    public function index(Dispatcher $dispatcher): View
    {
        return view('page.home.home', [
            'articles'      => Article::latestPublished()->take(11)->get(),
            'articlesCount' => Article::published()->count(),
        ]);
    }

    /**
     * @param  JWTInterface                                                  $jwt
     * @param  Guard                                                         $guard
     * @return \Illuminate\Contracts\View\Factory|View|\Illuminate\View\View
     */
    public function react(JWTInterface $jwt, Guard $guard): View
    {
        $user = User::guest();

        if ($guard->check()) {
            $user = $guard->user();
        }

        return view('layout.react', [
            'token' => $jwt->encode([
                'user'  => [
                    'id'       => $user->getAuthIdentifier(),
                    'password' => $user->getAuthPassword(),
                ],
                'token' => $user->getRememberToken(),
            ]),
        ]);
    }
}
