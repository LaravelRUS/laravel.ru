<?php declare(strict_types=1);
/**
 * This file is part of laravel.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

/**
 * Class TagType
 * @package App\GraphQL\Types
 */
class TagType extends GraphQLType
{
    /**
     * @var array
     */
    protected $attributes = [
        'name'        => 'Tag',
        'description' => 'An tag item',
    ];

    /**
     * @return array
     */
    public function fields()
    {
        return [
            'id'           => [
                'type'        => Type::nonNull(Type::id()),
                'description' => '',
            ],
            'name'         => [
                'type'        => Type::nonNull(Type::string()),
                'description' => '',
            ],
            'color'        => [
                'type'        => Type::nonNull(Type::string()),
                'description' => '',
            ],
        ];
    }
}