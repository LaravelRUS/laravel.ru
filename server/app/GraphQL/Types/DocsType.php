<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\GraphQL\Types;

use App\Models\DocsPage;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use App\GraphQL\Serializers\DocsPageSerializer;
use App\GraphQL\Queries\Support\WhereInSelection;

/**
 * Class DocsType.
 */
class DocsType extends AbstractType
{
    use WhereInSelection;

    /**
     * @var array
     */
    protected $attributes = [
        'name'        => 'Docs',
        'description' => 'Documentation repository',
    ];

    /**
     * @return array
     */
    public function fields(): array
    {
        return [
            'id'          => [
                'type'        => Type::nonNull(Type::id()),
                'description' => 'Docs identifier',
            ],
            'project'     => [
                'type'        => Type::nonNull(Type::string()),
                'description' => 'Docs project name',
            ],
            'pages'       => [
                'args'        => $this->argumentsWithWhereIn([
                    'slug' => [
                        'type'        => Type::string(),
                        'description' => 'Docs page slug',
                    ],
                ]),
                'type'        => Type::listOf(\GraphQL::type(DocsPageType::getName())),
                'description' => '',
            ],
            'title'       => [
                'type'        => Type::nonNull(Type::string()),
                'description' => '',
            ],
            'image'       => [
                'type'        => Type::nonNull(Type::string()),
                'description' => '',
            ],
            'version'     => [
                'type'        => Type::nonNull(Type::string()),
                'description' => '',
            ],
            'description' => [
                'type'        => Type::nonNull(Type::string()),
                'description' => '',
            ],
            'created_at'  => [
                'type'        => Type::nonNull(Type::string()),
                'description' => '',
            ],
            'updated_at'  => [
                'type'        => Type::nonNull(Type::string()),
                'description' => '',
            ],
        ];
    }

    /**
     * @param $root
     * @param array $args
     * @return \Illuminate\Support\Collection
     */
    public function resolvePagesField(array $root, array $args)
    {
        $query = DocsPage::whereDocsId($root['id']);

        $query = $this->queryWithWhereIn($query, $args);

        $this->whenExists($args, 'slug', function (string $slug) use ($query) {
            return $query->where('slug', $slug);
        });

        return DocsPageSerializer::collection($query->get());
    }
}
