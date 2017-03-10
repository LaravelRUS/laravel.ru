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
use Illuminate\Support\Collection;
use Illuminate\Database\Query\Builder;
use GraphQL\Type\Definition\ListOfType;
use App\GraphQL\Serializers\TipSerializer;

/**
 * Class TipsQuery.
 */
class TipsQuery extends AbstractQuery
{
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
    protected function queryArguments(): array
    {
        return [];
    }

    /**
     * @param             $root
     * @param  array      $args
     * @return Collection
     */
    public function resolve($root, array $args = []): Collection
    {
        /** @var Builder $query */
        $query = $this->queryFor(Tip::class, $args)
            ->with('likes', 'dislikes', 'user');

        return TipSerializer::collection($query->get());
    }
}
