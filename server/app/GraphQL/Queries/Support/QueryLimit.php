<?php

/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\GraphQL\Queries\Support;

use GraphQL\Type\Definition\Type;
use Illuminate\Database\Query\Builder as QBuilder;
use Illuminate\Database\Eloquent\Builder as EBuilder;

/**
 * Class QueryLimit.
 */
trait QueryLimit
{
    /**
     * @param  array $args
     * @return array
     */
    protected function argumentsWithLimit(array $args): array
    {
        return array_merge($args, [
            '_limit' => [
                'type'        => Type::int(),
                'description' => 'Items per page: in 1...1000 range',
            ],

            '_page'   => [
                'type'        => Type::int(),
                'description' => 'Current page number (Usage without "_limit" argument gives no effect)',
            ],
            '_after'  => [
                'type'        => Type::int(),
                'description' => 'Items after target ID',
            ],
            '_before' => [
                'type'        => Type::int(),
                'description' => 'Items before target ID',
            ],
        ]);
    }

    /**
     * @param  EBuilder|QBuilder $builder
     * @param  array $args
     * @return EBuilder
     */
    protected function queryWithLimit($builder, array &$args = [])
    {
        return $this->paginate($builder, $args);
    }

    /**
     * @param  EBuilder|QBuilder $builder
     * @param  array $args
     * @return EBuilder
     */
    protected function paginate($builder, array &$args = [])
    {
        $queryArgs = ['_after', '_before', '_limit', '_page'];

        switch (true) {
            case isset($args['_after']):
                $builder = $builder->where('id', '>', (int)$args['_after']);
                break;

            case isset($args['_before']):
                $builder = $builder->where('id', '<', (int)$args['_before']);
                break;

            case isset($args['_limit']):
                $builder = $builder->take($this->limit($args));
                if (isset($args['_page'])) {
                    $builder = $this->checkPageAndLimit($builder, $args);
                }
                break;
        }

        foreach ($queryArgs as $arg) {
            if (isset($args[$arg])) {
                unset($args[$arg]);
            }
        }

        return $builder;
    }

    /**
     * @param array $args
     * @return int
     */
    private function limit(array $args = []): int
    {
        return max(1, min(1000, (int)$args['_limit']));
    }

    /**
     * @param $builder
     * @param array $args
     * @return mixed
     */
    private function checkPageAndLimit($builder, array $args = [])
    {
        $page = max(1, (int)$args['_page']);

        $builder = $builder->skip(($page - 1) * $this->limit($args));

        return $builder;
    }
}
