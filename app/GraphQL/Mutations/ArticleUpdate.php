<?php declare(strict_types = 1);
/**
 * This file is part of laravel.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace App\GraphQL\Mutations;

use App\GraphQL\Serializers\ArticleSerializer;
use App\GraphQL\Types\ArticleType;
use App\Models\Article;
use GraphQL;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

/**
 * Class ArticleUpdate
 *
 * @package App\GraphQL\Mutations
 */
class ArticleUpdate extends Mutation
{
    /**
     * @var array
     */
    protected $attributes = [ 
        'name' => 'article_update' 
    ];

    /**
     * @param $root
     * @param array $args
     */
    public function resolve($root, array $args = [])
    {
        throw new \InvalidArgumentException('This mutator has no effect');
    }

    /**
     * @return ObjectType|mixed|null
     */
    public function type()
    {
        return GraphQL::type(ArticleType::getName());
    }

    /**
     * @return array
     */
    public function args()
    {
        return [
            'id'       => [
                'name' => 'id',
                'type' => Type::nonNull(Type::string())
            ],
            'title' => [
                'name' => 'title',
                'type' => Type::string()
            ],
            'content' => [
                'name' => 'content',
                'type' => Type::string()
            ],
            'published_at' => [
                'name' => 'published_at',
                'type' => Type::string()
            ],
        ];
    }

}
