<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\Models\Docs;
use App\GraphQL\Types\DocsType;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Collection;
use GraphQL\Type\Definition\ListOfType;
use App\GraphQL\Serializers\DocsSerializer;

/**
 * Class DocsQuery.
 */
class DocsQuery extends AbstractQuery
{
    /**
     * @var array
     */
    protected $attributes = [
        'name'        => 'Docs list query',
        'description' => 'Returns a list of available documentation repositories',
    ];

    /**
     * @return ListOfType
     */
    public function type(): ListOfType
    {
        return Type::listOf(\GraphQL::type(DocsType::getName()));
    }

    /**
     * @param        $root
     * @param  array $args
     * @return Collection
     */
    public function resolve($root, array $args = []): Collection
    {
        $query = $this->queryFor(Docs::class, $args)
            ->with('pages');

        return DocsSerializer::collection($query->get());
    }

    /**
     * @return array
     */
    protected function queryArguments(): array
    {
        return [];
    }
}
