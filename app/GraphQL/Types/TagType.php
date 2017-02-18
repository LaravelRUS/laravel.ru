<?php

/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;

class TagType extends AbstractType
{
    protected $attributes = [
        'name'        => 'Tag',
        'description' => 'Tag object',
    ];

    public function fields(): array
    {
        return [
            'id'           => [
                'type'        => Type::nonNull(Type::id()),
                'description' => 'Tag identifier',
            ],
            'name'         => [
                'type'        => Type::nonNull(Type::string()),
                'description' => 'Tag name',
            ],
            'color'        => [
                'type'        => Type::nonNull(Type::string()),
                'description' => 'Tag color',
            ],
        ];
    }
}
