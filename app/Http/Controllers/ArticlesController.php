<?php declare(strict_types=1);
/**
 * This file is part of laravel.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

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
            'articles' => Article::latestPublished()->paginate(10)
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