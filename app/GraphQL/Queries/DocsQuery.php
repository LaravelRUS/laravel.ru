<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);


namespace App\GraphQL\Queries;

use App\GraphQL\Serializers\DocsSerializer;
use App\Models\Docs;
use App\GraphQL\Types\DocsType;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Collection;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ListOfType;
use App\GraphQL\Queries\Support\QueryLimit;
use App\GraphQL\Serializers\ArticleSerializer;

/**
 * Class DocsQuery.
 */
class DocsQuery extends Query
{
    use QueryLimit;

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
     * @return array
     */
    public function args(): array
    {
        return $this->argumentsWithLimit([]);
    }

    /**
     * @param $root
     * @param  array      $args
     * @return Collection
     */
    public function resolve($root, array $args = []): Collection
    {
        $query = Docs::with('pages');

        $query = $this->paginate($query, $args);

        foreach ($args as $field => $value) {
            $query = $query->where($field, $value);
        }

        return DocsSerializer::collection($query->get());
    }
}
