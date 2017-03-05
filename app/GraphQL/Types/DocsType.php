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
 * Class DocsType.
 */
class DocsType extends AbstractType
{
    /**
     * @var array
     */
    protected $attributes = [
        'name'        => 'Docs',
        'description' => 'Documentation repository',
    ];

    /**
     * @return array
     */
    public function fields(): array
    {
        return [
            'id'          => [
                'type'        => Type::nonNull(Type::id()),
                'description' => 'Docs identifier',
            ],
            'pages'       => [
                'type'        => Type::listOf(\GraphQL::type(DocsPageType::getName())),
                'description' => '',
            ],
            'title'       => [
                'type'        => Type::nonNull(Type::string()),
                'description' => '',
            ],
            'image'       => [
                'type'        => Type::nonNull(Type::string()),
                'description' => '',
            ],
            'version'     => [
                'type'        => Type::nonNull(Type::string()),
                'description' => '',
            ],
            'description' => [
                'type'        => Type::nonNull(Type::string()),
                'description' => '',
            ],
            'created_at'  => [
                'type'        => Type::nonNull(Type::string()),
                'description' => '',
            ],
            'updated_at'  => [
                'type'        => Type::nonNull(Type::string()),
                'description' => '',
            ],
        ];
    }
}
