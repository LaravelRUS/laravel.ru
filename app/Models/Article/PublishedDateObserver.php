<?php declare(strict_types = 1);
/**
 * This file is part of laravel.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace App\Models\Article;

use App\Models\Article;
use Carbon\Carbon;

/**
 * Class PublishedDateObserver
 *
 * @package App\Models\Article
 */
class PublishedDateObserver
{
    /**
     * @param Article $article
     */
    public function saving(Article $article)
    {
        if (!$article->published_at) {
            $article->published_at = Carbon::now();
        }
    }
}
