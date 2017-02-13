<?php declare(strict_types=1);
/**
 * This file is part of laravel.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;

/**
 * Class UserType
 * @package App\GraphQL\Types
 */
class UserType extends AbstractType
{
    /**
     * @var array
     */
    protected $attributes = [
        'name'        => 'User',
        'description' => 'User object',
    ];

    /**
     * @return array
     */
    public function fields()
    {
        return [
            'id'           => [
                'type'        => Type::nonNull(Type::id()),
                'description' => 'User identifier',
            ],
            'name'         => [
                'type'        => Type::nonNull(Type::string()),
                'description' => 'User name',
            ],
            'email'        => [
                'type'        => Type::nonNull(Type::string()),
                'description' => 'User email',
            ],
            'avatar'       => [
                'type'        => Type::nonNull(Type::string()),
                'description' => 'User avatar url',
            ],
            'is_confirmed' => [
                'type'        => Type::nonNull(Type::boolean()),
                'description' => 'User confirmation status',
            ],
        ];
    }
}
