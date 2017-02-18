<?php

/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Models\Article;

use App\Models\Article;
use Illuminate\Support\Str;

/**
 * Class SlugObserver
 *
 * @package App\Models\Article
 */
class SlugObserver
{
    /**
     * @param Article $article
     */
    public function creating(Article $article)
    {
        $article->slug = Str::slug($article->title) . '-' . ($this->getElementsLastId() + 1);
    }

    /**
     * @return int
     */
    private function getElementsLastId(): int
    {
        $lastArticle = Article::orderBy('id', 'desc')->first();

        return $lastArticle ? $lastArticle->id : 0;
    }
}
