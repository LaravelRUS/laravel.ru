<?php

/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\GraphQL\Serializers\UserSerializer;
use App\GraphQL\Types\UserType;
use App\Models\User;
use GraphQL\Type\Definition\ListOfType;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Collection;

/**
 * Class UsersQuery.
 */
class UsersQuery extends AbstractQuery
{
    /**
     * @var array
     */
    protected $attributes = [
        'name'        => 'Users list query',
        'description' => 'Returns a list of users',
    ];

    /**
     * @return ListOfType
     */
    public function type(): ListOfType
    {
        return Type::listOf(\GraphQL::type(UserType::getName()));
    }

    /**
     * @return array
     */
    protected function queryArguments(): array
    {
        return [];
    }

    /**
     * @param        $root
     * @param  array $args
     * @return Collection
     */
    public function resolve($root, array $args = []): Collection
    {
        $query = $this->queryFor(User::class, $args);

        return UserSerializer::collection($query->get());
    }
}
