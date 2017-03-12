<?php
/**
 * This file is part of laravel.ru package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\GraphQL\Types\SearchResultType;
use GraphQL\Type\Definition\ListOfType;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Collection;
use Service\SearchService\SearchRepositoryInterface;

/**
 * Class SearchQuery
 * @package App\GraphQL\Queries
 */
class SearchQuery extends AbstractQuery
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
     */
    public function resolve($root, array $args = []): Collection
    {
        // TODO Query can be empty
        return app(SearchRepositoryInterface::class)
            ->getItems($args['query'], $args['type'] ?? null);
    }

    /**
     * @return array
     */
    protected function queryArguments(): array
    {
        return [
            'type'  => [
                'type'        => Type::string(),
                'description' => 'Can be one of docs, articles',
            ],
            'query' => [
                'type'        => Type::nonNull(Type::string()),
                'description' => '',
            ],
        ];
    }
}