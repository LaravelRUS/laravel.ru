<?php

/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\GraphQL\Types;

use App\GraphQL\Kernel\EnumTransfer;
use App\Models\Article;
use GraphQL\Type\Definition\Type;

/**
 * Class ArticleType.
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
            'id'             => [
                'type'        => Type::nonNull(Type::id()),
                'description' => 'Article identifier',
            ],
            'title'          => [
                'type'        => Type::nonNull(Type::string()),
                'description' => 'Article title',
            ],
            'slug'           => [
                'type'        => Type::string(),
                'description' => 'Article slug (part of url)',
            ],
            'url'            => [
                'type'        => Type::string(),
                'description' => 'Article url',
            ],
            'image'          => [
                'type'        => Type::nonNull(Type::string()),
                'description' => 'Article preview image',
            ],
            'content'        => [
                'type'        => Type::nonNull(Type::string()),
                'description' => 'Article rendered content',
            ],
            'content_source' => [
                'type'        => Type::nonNull(Type::string()),
                'description' => 'Article content source (original)',
            ],
            'preview'        => [
                'type'        => Type::string(),
                'description' => 'Article content preview',
            ],
            'preview_source' => [
                'type'        => Type::string(),
                'description' => 'Article content preview (original)',
            ],
            'status'         => [
                'type'        => app(EnumTransfer::class)->toGraphQL(Article\Status::class),
                'description' => 'Article status',
            ],
            'published_at'   => [
                'type'        => Type::string(),
                'description' => 'Article publishing date and time in RFC3339 format',
            ],
            'user'           => [
                'type'        => \GraphQL::type(UserType::getName()),
                'description' => 'Article author relation',
            ],
            'tags'           => [
                'type'        => Type::listOf(\GraphQL::type(TagType::getName())),
                'description' => 'Article tags',
            ],
        ];
    }
}
