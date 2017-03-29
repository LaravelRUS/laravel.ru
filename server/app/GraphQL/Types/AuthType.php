<?php
/**
 * Created by PhpStorm.
 * User: dmitry
 * Date: 28.03.17
 * Time: 11:55
 */

namespace App\GraphQL\Types;


use GraphQL\Type\Definition\Type;

class AuthType extends UserType
{
    protected $attributes = [
        'name' => 'AuthType',
        'description' => 'Auth Object type'
    ];

    public function fields(): array
    {
        $fields = parent::fields();
        $fields['token'] = ['type' => Type::nonNull(Type::string()),
        'description' => 'User secret auth token'];
        return $fields;
    }
}