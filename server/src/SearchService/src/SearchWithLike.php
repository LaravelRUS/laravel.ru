<?php
/**
 * This file is part of laravel.ru package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Service\SearchService;

use App\Models\Article;
use App\Models\Docs;
use App\Models\DocsPage;
use Illuminate\Support\Collection;

/**
 * Class SearchWithLike
 * @package Service\SearchService
 */
class SearchWithLike implements SearchRepositoryInterface
{
    /**
     * @param string $query
     * @param string|null $type
     * @param int $limit
     * @return Collection
     */
    public function getItems(string $query, string $type = null, int $limit = 10): Collection
    {
        // ACHTUNG !!!!

        switch ($type) {
            case 'docs':
                return $this->getDocs($query, $limit);

            case 'articles':
                return $this->getArticles($query, $limit);
        }

        return $this->getDocs($query, $limit)
            ->union($this->getArticles($query, $limit))
            ->take(10);
    }

    /**
     * @param string $query
     * @param int $limit
     * @return Collection
     */
    private function getDocs(string $query, int $limit = 10): Collection
    {
        return DocsPage::query()
            ->with('docs')
            ->where('content_source', 'LIKE', '%' . $query . '%')
            ->take($limit)
            ->get(['docs_id', 'slug', 'title', 'content_rendered'])
            ->map(function (DocsPage $model) {
                $dto = new SearchResult();

                $dto->title = $model->title;
                $dto->type = DocsPage::class;


                $dto->url = route('docs.show', [
                    'version' => $model->docs->version,
                    'slug'    => $model->slug,
                ]);
                $dto->slug = $model->slug;
                $dto->body = $model->content_rendered;

                return $dto;
            });
    }

    /**
     * @param string $query
     * @param int $limit
     * @return Collection
     */
    private function getArticles(string $query, int $limit = 10): Collection
    {
        return Article::query()
            ->where('content_source', 'LIKE', '%' . $query . '%')
            ->take($limit)
            ->get(['slug', 'title', 'content_rendered'])
            ->map(function (Article $model) {
                $dto = new SearchResult();

                $dto->title = $model->title;
                $dto->type = Article::class;

                $dto->url = route('articles.show', ['slug' => $model->slug]);
                $dto->slug = $model->slug;
                $dto->body = $model->content_rendered;

                return $dto;
            });
    }
}