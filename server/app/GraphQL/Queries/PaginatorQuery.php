<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\GraphQL\Queries;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ObjectType;
use App\GraphQL\Feature\Paginator\PaginatorConfiguration;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class PaginatorQuery
 * @package App\GraphQL\Queries
 */
class PaginatorQuery extends AbstractQuery
{
    /**
     * @var array
     */
    protected $attributes = [
        'name'        => 'Paginator query',
        'description' => 'Returns an info about query',
    ];

    /**
     * @return ObjectType
     */
    public function type(): ObjectType
    {
        return \GraphQL::type('Paginator');
    }

    /**
     * @param $root
     * @param array $args
     * @return array
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function resolve($root, array $args = []): array
    {
        $paginator = PaginatorConfiguration::find($args['query']);
        if ($paginator === null) {
            throw new NotFoundHttpException('No info about ' . $args['query'] . ' query');
        }

        return [
            'total_count'   => $paginator->getCount(),
            'pages_count'   => $paginator->getPages(),
            'limit'         => $paginator->getLimit(),
            'skip'          => $paginator->getSkip(),
            'page'          => $paginator->getPage(),
            'per_page'      => $paginator->getPerPage(),
            'is_first_page' => $paginator->getSkip() === 0,
            'is_last_page'  => $paginator->getPage() >= $paginator->getPages(),
        ];
    }

    /**
     * @return array
     */
    protected function queryArguments(): array
    {
        return [
            'query' => [
                'name' => 'query',
                'type' => Type::nonNull(Type::string()),
            ],
        ];
    }
}