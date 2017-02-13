<?php declare(strict_types = 1);
/**
 * This file is part of laravel.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace App\GraphQL\Queries\Support;

use GraphQL\Type\Definition\Type;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class QueryLimit
 *
 * @package App\GraphQL\Queries\Support
 */
trait QueryLimit
{
    /**
     * @param array $args
     * @return array
     */
    public function argumentsWithLimit(array $args): array
    {
        return array_merge($args, [
            '_limit' => [
                'type'        => Type::int(),
                'description' => 'Items per page: in 1...1000 range'
            ],
            '_page'  => [
                'type'        => Type::int(),
                'description' => 'Current page number (Usage without "_limit" argument gives no effect)'
            ],
        ]);
    }

    /**
     * @param Builder|\Illuminate\Database\Query\Builder $builder
     * @param array $args
     * @return Builder
     */
    public function paginate(Builder $builder, array &$args = [])
    {
        $limit = null;

        if (isset($args['_limit'])) {
            $limit = max(1, min(1000, (int)$args['_limit']));

            $builder = $builder->take($limit);

            if (isset($args['_page'])) {
                $page = max(1, (int)$args['_page']);

                $builder = $builder->skip(($page - 1) * $limit);
            }

            unset($args['_limit']);
        }


        if (isset($args['_page'])) {
            unset($args['_page']);
        }

        return $builder;
    }
}
