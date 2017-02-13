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
 * Class TagType
 * @package App\GraphQL\Types
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
    public function fields()
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
