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
use GraphQL\Type\Definition\ListOfType;
use App\GraphQL\Serializers\ArticleSerializer;

/**
 * Class ArticlesQuery.
 */
class ArticlesQuery extends AbstractCollectionQuery
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
        return Type::listOf(\GraphQL::type(ArticleType::getName()));
    }

    /**
     * @return array
     */
    protected function queryArguments(): array
    {
        return [];
    }

    /**
     * @param $root
     * @param  array      $args
     * @return Collection
     */
    public function resolve($root, array $args = []): Collection
    {
        $query = $this->queryFor(Article::class, $args)
            ->latestPublished();

        return ArticleSerializer::collection($query->get());
    }
}
