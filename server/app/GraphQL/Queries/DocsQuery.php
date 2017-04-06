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
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use GraphQL\Type\Definition\ListOfType;
use App\GraphQL\Serializers\DocsSerializer;

/**
 * Class DocsQuery.
 */
class DocsQuery extends AbstractCollectionQuery
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
            ->with('pages.docs');

        $this->checkVersion($query, $args);
        $this->checkProject($query, $args);

        return DocsSerializer::collection($query->get());
    }

    /**
     * @param Builder $query
     * @param array $args
     * @return Builder|null
     */
    private function checkProject(Builder $query, array $args): ?Builder
    {
        return $this->whenExists($args, 'project', function(string $project) use ($query) {
            return $query->where('slug', $project);
        });
    }

    /**
     * @param Builder $query
     * @param array $args
     * @return Builder
     */
    private function checkVersion(Builder $query, array $args): ?Builder
    {
        return $this->whenExists($args, 'version', function (string $version) use ($query) {
            if ($version === 'latest') {
                return $query->orderBy('version', 'desc')
                    ->take(1);
            }

            return $query->where('version', $version);
        });
    }

    /**
     * @return array
     */
    protected function queryArguments(): array
    {
        return [
            'version' => [
                'name'        => 'version',
                'type'        => Type::string(),
            ],
            'project' => [
                'name'        => 'project',
                'type'        => Type::string(),
            ],
        ];
    }
}
