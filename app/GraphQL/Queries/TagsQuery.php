<?php declare(strict_types = 1);
/**
 * This file is part of laravel.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace App\GraphQL\Queries;

use App\GraphQL\Queries\Support\QueryLimit;
use App\GraphQL\Serializers\TagSerializer;
use App\GraphQL\Types\TagType;
use App\Models\Tag;
use Folklore\GraphQL\Support\Query;
use GraphQL;
use GraphQL\Type\Definition\Type;

/**
 * Class TagsQuery
 *
 * @package App\GraphQL
 */
class TagsQuery extends Query
{
    use QueryLimit;

    /**
     * @var array
     */
    protected $attributes = [
        'name'        => 'Tags list query',
        'description' => 'Returns a list of available tags',
    ];

    /**
     * @return GraphQL\Type\Definition\ListOfType
     */
    public function type()
    {
        return Type::listOf(GraphQL::type(TagType::getName()));
    }

    /**
     * @return array
     */
    public function args()
    {
        return $this->argumentsWithLimit([
            'id' => [
                'type'        => Type::id(),
                'description' => 'Tag identifier',
            ],
        ]);
    }

    /**
     * @param $root
     * @param array $args
     * @return \Illuminate\Support\Collection
     * @throws \InvalidArgumentException
     */
    public function resolve($root, array $args = [])
    {
        $query = Tag::query();

        $query = $this->paginate($query, $args);

        foreach ($args as $field => $value) {
            $query = $query->where($field, $value);
        }

        return TagSerializer::collection($query->get());
    }
}
