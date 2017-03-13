<?php
/**
 * This file is part of laravel.ru package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Models\Article;

use App\Models\Article;
use Illuminate\Support\Collection;
use Service\SearchService\SearchResult;
use Service\SearchService\Repository\SearchRepositoryInterface;

/**
 * Class ArticlesSearchRepository
 * @package App\Models\Article
 */
class ArticlesSearchRepository implements SearchRepositoryInterface
{
    /**
     * @return string
     */
    public function getName(): string
    {
        return 'articles';
    }

    /**
     * @param string $query
     * @param int $limit
     * @return Collection|SearchResult[]
     */
    public function getSearchResults(string $query, int $limit = 10): Collection
    {
        return Article::query()
            ->where('content_source', 'LIKE', '%' . $query . '%')
            ->take($limit)
            ->get(['slug', 'title', 'content_rendered'])
            ->map(function (Article $model) {
                return $this->transform($model);
            });
    }

    /**
     * @param Article $article
     * @return SearchResult
     */
    private function transform(Article $article): SearchResult
    {
        $dto = new SearchResult();

        $dto->title = $article->title;
        $dto->type = Article::class;

        $dto->url = route('articles.show', ['slug' => $article->slug]);
        $dto->slug = $article->slug;
        $dto->body = $article->content_rendered;

        return $dto;
    }
}