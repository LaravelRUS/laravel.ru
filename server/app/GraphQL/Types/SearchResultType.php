<?php
/**
 * This file is part of laravel.ru package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;

/**
 * Class SearchResultType
 * @package App\GraphQL\Types
 */
class SearchResultType extends AbstractType
{
    /**
     * @var array
     */
    protected $attributes = [
        'name'        => 'Serach result type',
        'description' => 'Type for search results',
    ];

    /**
     * @return array
     */
    public function fields(): array
    {
        return [
            'slug'   => [
                'type'        => Type::nonNull(Type::string()),
                'description' => '',
            ],
            'url'   => [
                'type'        => Type::nonNull(Type::string()),
                'description' => '',
            ],
            'content' => [
                'type'        => Type::nonNull(Type::string()),
                'description' => '',
            ],
            'title'   => [
                'type'        => Type::string(),
                'description' => '',
            ],
            'type'    => [
                'type'        => Type::string(),
                'description' => 'Related to articles, docs_pages, docs or more',
            ],
        ];
    }
}