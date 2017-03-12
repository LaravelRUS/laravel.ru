<?php
/**
 * This file is part of laravel.ru package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Service\SearchService;

use Illuminate\Support\Collection;

/**
 * Interface SearchRepositoryInterface
 * @package Service\SearchService
 */
interface SearchRepositoryInterface
{
    /**
     * @param string $query
     * @param string|null $type
     * @param int $limit
     * @return Collection|SearchResult[]
     */
    public function getItems(string $query, string $type = null, int $limit = 10): Collection;
}