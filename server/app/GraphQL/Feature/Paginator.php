<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\GraphQL\Feature;

use GraphQL\Type\Definition\Type;
use Illuminate\Database\Eloquent\Builder;
use App\GraphQL\Feature\Kernel\FeaturesSupport;
use App\GraphQL\Feature\Paginator\PaginatorConfiguration as P;

/**
 * Class Paginator
 * @mixin FeaturesSupport
 */
trait Paginator
{
    /**
     * @return void
     */
    public function bootPaginator(): void
    {
        $limit = [P::QUERY_LIMIT, Type::int(), 'Items per page: in 1...1000 range'];
        $page  = [P::QUERY_PAGE, Type::int(), 'Current page number (Usage without "_limit" argument gives no effect)'];

        $this->addArgument(...$limit);
        $this->addArgument(...$page);
    }

    /**
     * @param Builder $builder
     * @param int $count
     * @return P
     */
    protected function paginate(Builder $builder, int $count): P
    {
        return new P($builder, $count);
    }
}