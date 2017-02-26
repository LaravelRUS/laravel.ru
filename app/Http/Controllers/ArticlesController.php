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
use Illuminate\Contracts\Auth\Guard;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

/**
 * Class ArticlesController.
 */
class ArticlesController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        return view('page.articles.index', [
            'articles' => Article::latestPublished()->paginate(10),
        ]);
    }

    /**
     * @param  string $slug
     * @param  Guard  $guard
     * @return string
     *
     * @throws \Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException
     * @throws
     */
    public function show(string $slug, Guard $guard)
    {
        /** @var Article $article */
        $article = Article::where('slug', $slug)->firstOrFail();

        if (! $article->isAllowedForUser($guard->user())) {
            throw new AccessDeniedHttpException('Article [' . $article->slug . '] are not allowed for view');
        }

        return view('page.articles.show', [
            'article' => $article,
        ]);
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
