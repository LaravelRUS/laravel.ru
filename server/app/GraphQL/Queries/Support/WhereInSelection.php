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
 * Class WhereInSelection.
 */
trait WhereInSelection
{
    /**
     * @param array $args
     * @return array
     */
    protected function argumentsWithWhereIn(array $args): array
    {
        return array_merge($args, [
            'id'  => [
                'type'        => Type::listOf(Type::id()),
                'description' => 'Select ' . $this->getQueryName() . ' by identifier or identifier array',
            ],
        ]);
    }

    /**
     * @return string
     */
    private function getQueryName(): string
    {
        $short = (new \ReflectionObject($this))->getShortName();

        return str_replace('Query', '', $short);
    }

    /**
     * @param  EBuilder|QBuilder $builder
     * @param  array             $args
     * @return EBuilder
     */
    protected function queryWithWhereIn($builder, array &$args = [])
    {
        if (isset($args['id'])) {
            if (count($args['id']) === 1) {
                $builder->where('id', reset($args['id']));
            } else {
                $builder->whereIn('id', $args['id']);
            }

            unset($args['id']);
        }

        return $builder;
    }
}
