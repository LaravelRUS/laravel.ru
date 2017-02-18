<?php

/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\GraphQL\Types;

use App\Models\Article;
use GraphQL\Type\Definition\Type;

/**
 * Class ArticleType
 *
 * @package App\GraphQL\Types
 */
class ArticleType extends AbstractType
{
    /**
     * @var array
     */
    protected $attributes = [
        'name'        => 'Article',
        'description' => 'Article object',
    ];

    /**
     * @return array
     */
    public function fields(): array
    {
        return [
            'id'           => [
                'type'        => Type::nonNull(Type::id()),
                'description' => 'Article identifier',
            ],
            'title'        => [
                'type'        => Type::nonNull(Type::string()),
                'description' => 'Article title',
            ],
            'url'          => [
                'type'        => Type::string(),
                'description' => 'Article url',
            ],
            'image'        => [
                'type'        => Type::nonNull(Type::string()),
                'description' => 'Article preview image',
            ],
            'content'      => [
                'type'        => Type::nonNull(Type::string()),
                'description' => 'Article rendered content',
            ],
            'source'       => [
                'type'        => Type::nonNull(Type::string()),
                'description' => 'Article content source (original)',
            ],
            'status'       => [
                'type'        => Article\Status::toGraphQL(),
                'description' => 'Article status',
            ],
            'published_at' => [
                'type'        => Type::string(),
                'description' => 'Article publishing date and time in RFC3339 format',
            ],
            'user'         => [
                'type'        => \GraphQL::type(UserType::getName()),
                'description' => 'Article author relation',
            ],
            'tags'         => [
                'type'        => Type::listOf(\GraphQL::type(TagType::getName())),
                'description' => 'Article tags',
            ],
        ];
    }
}
