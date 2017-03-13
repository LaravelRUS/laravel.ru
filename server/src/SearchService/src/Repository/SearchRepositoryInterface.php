<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Service\SearchService\Repository;

use Illuminate\Support\Collection;

/**
 * Interface SearchRepositoryInterface
 * @package Service\SearchService
 */
interface SearchRepositoryInterface
{
    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param string|null $query
     * @param int $limit
     * @return Collection
     */
    public function getSearchResults(string $query, int $limit = 10): Collection;
}