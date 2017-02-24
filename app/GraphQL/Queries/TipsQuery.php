<?php

/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\Models\Tip;
use App\GraphQL\Types\TipType;
use GraphQL\Type\Definition\Type;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ListOfType;
use App\GraphQL\Serializers\TipSerializer;
use App\GraphQL\Queries\Support\QueryLimit;

/**
 * Class TipsQuery.
 */
class TipsQuery extends Query
{
    use QueryLimit;

    /**
     * @var array
     */
    protected $attributes = [
        'name'        => 'Tips list query',
        'description' => 'Returns a list of available tips',
    ];

    /**
     * @return ListOfType
     */
    public function type(): ListOfType
    {
        return Type::listOf(\GraphQL::type(TipType::getName()));
    }

    /**
     * @return array
     */
    public function args(): array
    {
        return $this->argumentsWithLimit([
            'id' => [
                'type'        => Type::id(),
                'description' => 'Tip identifier',
            ],
        ]);
    }

    /**
     * @param        $root
     * @param  array $args
     * @return Collection
     */
    public function resolve($root, array $args = []): Collection
    {
        /** @var Builder $query */
        $query = Tip::with('likes', 'dislikes', 'user');

        $query = $this->paginate($query, $args);

        foreach ($args as $field => $value) {
            $query = $query->where($field, $value);
        }

        return TipSerializer::collection($query->get());
    }
}
