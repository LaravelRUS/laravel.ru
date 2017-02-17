<?php

/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\GraphQL\Queries\Support\QueryLimit;
use App\GraphQL\Serializers\ArticleSerializer;
use App\GraphQL\Types\ArticleType;
use App\Models\Article;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ListOfType;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Collection;

class ArticlesQuery extends Query
{
    use QueryLimit;

    protected $attributes = [
        'name'        => 'Article list query',
        'description' => 'Returns a list of available articles',
    ];

    public function type(): ListOfType
    {
        return Type::listOf(\GraphQL::type(ArticleType::getName()));
    }

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

    public function resolve($root, array $args = []): Collection
    {
        $query = Article::query()
            ->with('user')
            ->with('tags');

        $query = $this->paginate($query, $args);

        foreach ($args as $field => $value) {
            $query = $query->where($field, $value);
        }

        return ArticleSerializer::collection($query->get());
    }
}
