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
 * Class PaginatorType
 * @package App\GraphQL\Types
 */
class PaginatorType extends AbstractType
{
    /**
     * @var array
     */
    protected $attributes = [
        'name'        => 'Paginator',
        'description' => 'Paginator type',
    ];

    /**
     * @return array
     */
    public function typeFields(): array
    {
        return [
            'total_count'   => [
                'type'        => Type::nonNull(Type::int()),
                'description' => 'Total count of elements',
            ],
            'pages_count'   => [
                'type'        => Type::nonNull(Type::int()),
                'description' => 'Total count of pages',
            ],
            'per_page'      => [
                'type'        => Type::nonNull(Type::int()),
                'description' => 'Count of elements in current page',
            ],
            'limit'         => [
                'type'        => Type::nonNull(Type::int()),
                'description' => 'Limit request query argument',
            ],
            'skip'          => [
                'type'        => Type::nonNull(Type::int()),
                'description' => 'Skip request query argument',
            ],
            'page'          => [
                'type'        => Type::nonNull(Type::int()),
                'description' => 'Page request query argument',
            ],
            'is_first_page' => [
                'type'        => Type::nonNull(Type::boolean()),
                'description' => 'Bool is first page',
            ],
            'is_last_page'  => [
                'type'        => Type::nonNull(Type::boolean()),
                'description' => 'Bool is last page',
            ],
        ];
    }
}