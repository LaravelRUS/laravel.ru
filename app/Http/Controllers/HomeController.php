<?php

/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Contracts\View\View;

/**
 * Class HomeController.
 */
class HomeController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        return view('page.home.home', [
            'articles'      => Article::latestPublished()->take(11)->get(),
            'articlesCount' => Article::latestPublished()->count(),
        ]);
    }
}
