<?php

/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\Models\Tag;
use App\GraphQL\Types\TagType;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Collection;
use GraphQL\Type\Definition\ListOfType;
use App\GraphQL\Serializers\TagSerializer;

/**
 * Class TagsQuery.
 */
class TagsQuery extends AbstractQuery
{
    /**
     * @var array
     */
    protected $attributes = [
        'name'        => 'Tags list query',
        'description' => 'Returns a list of available tags',
    ];

    /**
     * @return ListOfType
     */
    public function type(): ListOfType
    {
        return Type::listOf(\GraphQL::type('Tag'));
    }

    /**
     * @return array
     */
    protected function queryArguments(): array
    {
        return [];
    }

    /**
     * @param $root
     * @param  array      $args
     * @return Collection
     */
    public function resolve($root, array $args = []): Collection
    {
        $query = $this->queryFor(Tag::class, $args);

        return TagSerializer::collection($query->get());
    }
}
