<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Service\SearchService;

use Service\SearchService\Repository\SearchRepositoryInterface;

/**
 * Class SearchService.
 */
class SearchService
{
    /**
     * @var array|SearchRepositoryInterface[]
     */
    private $repositories = [];

    /**
     * @param SearchRepositoryInterface $repository
     * @return SearchService
     */
    public function register(SearchRepositoryInterface $repository): SearchService
    {
        $this->repositories[$repository->getName()] = $repository;

        return $this;
    }

    /**
     * @param string $name
     * @return null|SearchRepositoryInterface
     */
    public function findByName(string $name): ?SearchRepositoryInterface
    {
        if (isset($this->repositories[$name])) {
            return $this->repositories[$name];
        }
    }

    /**
     * @return array
     */
    public function getCategories(): array
    {
        return array_keys($this->repositories);
    }
}
