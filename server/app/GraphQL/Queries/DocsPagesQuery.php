<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\GraphQL\Types\DocsPageType;
use App\Models\DocsPage;
use App\GraphQL\Serializers\DocsPageSerializer;
use GraphQL\Type\Definition\Type;

/**
 * Class DocsPagesQuery
 * @package App\GraphQL\Queries
 */
class DocsPagesQuery extends AbstractCollectionQuery
{
    /**
     * @var array
     */
    protected $attributes = [
        'name' => 'docs_pages'
    ];

    /**
     * @return \GraphQL\Type\Definition\ListOfType
     */
    public function type()
    {
        return Type::listOf(\GraphQL::type(DocsPageType::getName()));
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
     * @param array $args
     * @return \Illuminate\Support\Collection
     */
    public function resolve($root, array $args = [])
    {
        $query = $this->queryFor(DocsPage::class)
            ->with('docs');

        return DocsPageSerializer::collection($query->get());
    }
}