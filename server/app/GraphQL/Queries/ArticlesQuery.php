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
use App\GraphQL\Kernel\Paginator;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ListOfType;
use Illuminate\Contracts\Support\Arrayable;
use App\GraphQL\Serializers\ArticleSerializer;

/**
 * Class ArticlesQuery.
 */
class ArticlesQuery extends AbstractQuery
{
    use Paginator;

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
        return Type::listOf(\GraphQL::type('Article'));
    }

    /**
     * @return array
     */
    protected function queryArguments(): array
    {
        return Paginator\PaginatorConfiguration::withPaginatorArguments([

        ]);
    }

    /**
     * @param $root
     * @param array $args
     * @return \Traversable
     */
    public function resolve($root, array $args = []): \Traversable
    {
        $query = $this->queryFor(Article::class, $args);

        $count = $query->published()->count();
        $query = $query->latestPublished();

        return $this->paginate($query, $count)
            ->withArgs($args)
            ->use(ArticleSerializer::class)
            ->as('articles');
    }
}
