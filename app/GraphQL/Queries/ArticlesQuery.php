<?php

/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\Models\Article;
use GraphQL\Type\Definition\Type;
use App\GraphQL\Types\ArticleType;
use Illuminate\Support\Collection;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ListOfType;
use App\GraphQL\Queries\Support\QueryLimit;
use App\GraphQL\Serializers\ArticleSerializer;

/**
 * Class ArticlesQuery.
 */
class ArticlesQuery extends Query
{
    use QueryLimit;

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
        return Type::listOf(\GraphQL::type(ArticleType::getName()));
    }

    /**
     * @return array
     */
    public function args(): array
    {
        return $this->argumentsWithLimit([
            'id'     => [
                'type'        => Type::id(),
                'description' => 'Article identifier',
            ],
            'status' => [
                'type'        => Article\Status::toGraphQL(),
                'description' => 'Article visibility status',
            ],
        ]);
    }

    /**
     * @param $root
     * @param  array      $args
     * @return Collection
     */
    public function resolve($root, array $args = []): Collection
    {
        $query = Article::latestPublished();

        $query = $this->paginate($query, $args);

        foreach ($args as $field => $value) {
            $query = $query->where($field, $value);
        }

        return ArticleSerializer::collection($query->get());
    }
}
