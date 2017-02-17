<?php

/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\GraphQL\Queries\Support\QueryLimit;
use App\GraphQL\Serializers\TagSerializer;
use App\GraphQL\Types\TagType;
use App\Models\Tag;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ListOfType;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Collection;

/**
 * Class TagsQuery
 *
 * @package App\GraphQL
 */
class TagsQuery extends Query
{
    use QueryLimit;

    protected $attributes = [
        'name'        => 'Tags list query',
        'description' => 'Returns a list of available tags',
    ];

    public function type(): ListOfType
    {
        return Type::listOf(\GraphQL::type(TagType::getName()));
    }

    public function args(): array
    {
        return $this->argumentsWithLimit([
            'id' => [
                'type'        => Type::id(),
                'description' => 'Tag identifier',
            ],
        ]);
    }

    public function resolve($root, array $args = []): Collection
    {
        $query = Tag::query();

        $query = $this->paginate($query, $args);

        foreach ($args as $field => $value) {
            $query = $query->where($field, $value);
        }

        return TagSerializer::collection($query->get());
    }
}
