<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Models\DocsPage;

use App\Models\DocsPage;
use Illuminate\Support\Collection;
use Service\SearchService\SearchResult;
use Service\SearchService\Repository\SearchRepositoryInterface;

/**
 * Class DocsPagesSearchRepository.
 */
class DocsPagesSearchRepository implements SearchRepositoryInterface
{
    /**
     * @return string
     */
    public function getName(): string
    {
        return 'docs';
    }

    /**
     * @param string $query
     * @param int $limit
     * @return Collection|SearchResult[]
     */
    public function getSearchResults(string $query, int $limit = 10): Collection
    {
        return DocsPage::query()
            ->with('docs')
            ->where('content_source', 'LIKE', '%' . $query . '%')
            ->take($limit)
            ->get(['docs_id', 'slug', 'title', 'content_rendered'])
            ->map(function (DocsPage $model) {
                return $this->transform($model);
            });
    }

    /**
     * @param DocsPage $page
     * @return SearchResult
     */
    private function transform(DocsPage $page): SearchResult
    {
        $dto = new SearchResult();

        $dto->title = $page->title;
        $dto->type = DocsPage::class;
        $dto->slug = $page->slug;
        $dto->body = $page->content_rendered;

        $dto->url = route('docs.show', [
            'version' => $page->docs->version,
            'slug'    => $page->slug,
        ]);

        return $dto;
    }
}
