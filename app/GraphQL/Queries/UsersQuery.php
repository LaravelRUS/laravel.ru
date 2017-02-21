<?php

/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\Models\User;
use App\GraphQL\Types\UserType;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Collection;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ListOfType;
use App\GraphQL\Queries\Support\QueryLimit;
use App\GraphQL\Serializers\UserSerializer;

/**
 * Class UsersQuery.
 */
class UsersQuery extends Query
{
    use QueryLimit;

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
    public function args(): array
    {
        return $this->argumentsWithLimit([
            'id' => [
                'type'        => Type::id(),
                'description' => 'User identifier',
            ],
        ]);
    }

    /**
     * @param $root
     * @param array $args
     * @return Collection
     */
    public function resolve($root, array $args = []): Collection
    {
        $query = User::query();

        $query = $this->paginate($query, $args);

        foreach ($args as $field => $value) {
            $query = $query->where($field, $value);
        }

        return UserSerializer::collection($query->get());
    }
}
