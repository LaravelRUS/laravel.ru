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

/**
 * Class TagType.
 */
class TagType extends AbstractType
{
    /**
     * @var array
     */
    protected $attributes = [
        'name'        => 'Tag',
        'description' => 'Tag object',
    ];

    /**
     * @return array
     */
    public function fields(): array
    {
        return [
            'id'    => [
                'type'        => Type::nonNull(Type::id()),
                'description' => 'Tag identifier',
            ],
            'name'  => [
                'type'        => Type::nonNull(Type::string()),
                'description' => 'Tag name',
            ],
            'color' => [
                'type'        => Type::nonNull(Type::string()),
                'description' => 'Tag color',
            ],
        ];
    }
}
