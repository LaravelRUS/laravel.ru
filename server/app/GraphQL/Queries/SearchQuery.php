<?php
/**
 * This file is part of laravel.ru package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\GraphQL\Serializers\SearchResultsSerializer;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Collection;
use Folklore\GraphQL\Support\Query;
use App\GraphQL\Types\SearchResultType;
use GraphQL\Type\Definition\ListOfType;
use Service\SearchService\SearchService;

/**
 * Class SearchQuery
 * @package App\GraphQL\Queries
 */
class SearchQuery extends Query
{
    /**
     * @var array
     */
    protected $attributes = [
        'name'        => 'Article list query',
        'description' => 'Returns a list of available articles',
    ];

    /**
     * @return ListOfType
     */
    public function type(): ListOfType
    {
        return Type::listOf(\GraphQL::type(SearchResultType::getName()));
    }

    /**
     * @param $root
     * @param  array $args
     * @return Collection
     * @throws \InvalidArgumentException
     */
    public function resolve($root, array $args = []): Collection
    {
        $search = app(SearchService::class);

        $repo = $search->findByName($args['type']);

        if ($repo === null) {
            $message = 'Invalid type %s. Available types: %s';
            $types   = implode(', ', $search->getCategories());

            throw new \InvalidArgumentException(sprintf($message, $args['type'], $types));
        }


        $result = $repo->getSearchResults($args['query'], $this->formatLimit($args));

        return SearchResultsSerializer::collection($result);
    }

    /**
     * @param array $args
     * @return int
     */
    private function formatLimit(array $args = []): int
    {
        $limit = $args['_limit'] ?? 10;

        return max(10, min(100, $limit));
    }

    /**
     * @return array
     */
    public function args(): array
    {
        return [
            '_limit' => [
                'type'        => Type::int(),
                'description' => 'Search results limit',
            ],
            'type'  => [
                'type'        => Type::nonNull(Type::string()),
                'description' => 'Search category',
            ],
            'query' => [
                'type'        => Type::nonNull(Type::string()),
                'description' => 'Search query',
            ],
        ];
    }
}