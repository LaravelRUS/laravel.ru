<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;

/**
 * Class TipType.
 */
class TipType extends AbstractType
{
    /**
     * @var array
     */
    protected $attributes = [
        'name'        => 'Tip',
        'description' => 'Tip object',
    ];

    /**
     * @return array
     */
    public function fields(): array
    {
        return [
            'id'             => [
                'type'        => Type::nonNull(Type::id()),
                'description' => 'Tag identifier',
            ],
            'content'        => [
                'type'        => Type::nonNull(Type::string()),
                'description' => 'Tip rendered content',
            ],
            'content_source' => [
                'type'        => Type::nonNull(Type::string()),
                'description' => 'Tip content source (original)',
            ],
            'user'           => [
                'type'        => \GraphQL::type('User'),
                'description' => 'Tip author',
            ],
            'likes'          => [
                'type'        => Type::nonNull(Type::int()),
                'description' => 'Tip likes count',
            ],
            'dislikes'       => [
                'type'        => Type::nonNull(Type::int()),
                'description' => 'Tip dislikes count',
            ],
        ];
    }
}
