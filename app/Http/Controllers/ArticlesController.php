<?php declare(strict_types=1);
/**
 * This file is part of laravel.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace App\Http\Controllers;

use App\Models\Article;

/**
 * Class ArticlesController
 * @package App\Http\Controllers
 */
class ArticlesController extends Controller
{
    /**
     * @return string
     */
    public function index()
    {
        return view('page.articles.articles', [
            'articles' => Article::query()
                ->with('user')
                ->with('tags')
                ->latest()
                ->published()
                ->take(10)
                ->get()
        ]);
    }

    /**
     * @param $slug
     */
    public function show($slug)
    {

    }

    /**
     * @param $id
     * @return mixed
     */
    public function indexForTag($id)
    {
        return $id;
    }
}