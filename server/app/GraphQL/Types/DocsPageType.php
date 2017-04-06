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
 * Class DocsPageType.
 */
class DocsPageType extends AbstractType
{
    /**
     * @var array
     */
    protected $attributes = [
        'name'        => 'Docs page',
        'description' => 'Page of documentation repository',
    ];

    /**
     * @return array
     */
    public function fields(): array
    {
        return [
            'id'             => [
                'type'        => Type::nonNull(Type::id()),
                'description' => 'Docs identifier',
            ],
            'title'          => [
                'type'        => Type::nonNull(Type::string()),
                'description' => '',
            ],
            'slug'           => [
                'type'        => Type::nonNull(Type::string()),
                'description' => '',
            ],
            'content'        => [
                'type'        => Type::nonNull(Type::string()),
                'description' => 'Page rendered content',
            ],
            'content_source' => [
                'type'        => Type::nonNull(Type::string()),
                'description' => 'Page content source (original)',
            ],
            'created_at'     => [
                'type'        => Type::nonNull(Type::string()),
                'description' => '',
            ],
            'updated_at'     => [
                'type'        => Type::nonNull(Type::string()),
                'description' => '',
            ],
        ];
    }
}
