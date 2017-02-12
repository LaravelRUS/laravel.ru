<?php declare(strict_types=1);
/**
 * This file is part of laravel.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

/**
 * Class ArticleType
 * @package App\GraphQL\Types
 */
class ArticleType extends GraphQLType
{
    /**
     * @var array
     */
    protected $attributes = [
        'name'        => 'Article',
        'description' => 'An article item',
    ];

    /**
     * @return array
     */
    public function fields()
    {
        return [
            'id'           => [
                'type'        => Type::nonNull(Type::id()),
                'description' => '',
            ],
            'title'        => [
                'type'        => Type::nonNull(Type::string()),
                'description' => '',
            ],
            'url'          => [
                'type'        => Type::string(),
                'description' => '',
            ],
            'image'        => [
                'type'        => Type::nonNull(Type::string()),
                'description' => '',
            ],
            'content'      => [
                'type'        => Type::nonNull(Type::string()),
                'description' => '',
            ],
            'status'       => [
                'type'        => Type::string(),
                'description' => '',
            ],
            'published_at' => [
                'type'        => Type::string(),
                'description' => '',
            ],
            'user'         => [
                'type'        => \GraphQL::type(UserType::class),
                'description' => '',
            ],
            'tags'         => [
                'type'        => Type::listOf(\GraphQL::type(TagType::class)),
                'description' => '',
            ],
        ];
    }
}