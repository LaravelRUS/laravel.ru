<?php

/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\GraphQL\Mutations;

use GraphQL\Type\Definition\Type;
use App\GraphQL\Types\ArticleType;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\ObjectType;

class ArticleUpdate extends Mutation
{
    protected $attributes = [
        'name' => 'article_update',
    ];

    public function resolve($root, array $args = [])
    {
        throw new \InvalidArgumentException('This mutator has no effect');
    }

    public function type(): ?ObjectType
    {
        return \GraphQL::type(ArticleType::getName());
    }

    public function args(): array
    {
        return [
            'id'       => [
                'name' => 'id',
                'type' => Type::nonNull(Type::string()),
            ],
            'title' => [
                'name' => 'title',
                'type' => Type::string(),
            ],
            'content' => [
                'name' => 'content',
                'type' => Type::string(),
            ],
            'published_at' => [
                'name' => 'published_at',
                'type' => Type::string(),
            ],
        ];
    }
}
