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

class ArticlesController extends Controller
{
    public function index(): View
    {
        return view('page.articles.articles', [
            'articles' => Article::latestPublished()->paginate(10),
        ]);
    }

    public function show($slug)
    {
    }

    public function indexForTag($id)
    {
        return $id;
    }
}
