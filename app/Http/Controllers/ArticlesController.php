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
 * Class ArticlesController
 *
 * @package App\Http\Controllers
 */
class ArticlesController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        return view('page.articles.articles', [
            'articles' => Article::latestPublished()->paginate(10)
        ]);
    }

    /**
     * @param $slug
     *
     * @return string
     */
    public function show($slug)
    {
        return 'Article ' . $slug;
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function indexForTag($id)
    {
        return $id;
    }
}
