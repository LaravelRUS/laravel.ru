<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\GraphQL\Kernel;

use App\GraphQL\Kernel\Paginator\PaginatorConfiguration;
use App\GraphQL\Serializers\AbstractSerializer;
use Illuminate\Support\Collection;
use App\GraphQL\Serializers\RawSerializer;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class Paginator
 * @package App\GraphQL\Serializers\Support
 */
trait Paginator
{
    /**
     * @param Builder $builder
     * @param int $count
     * @return PaginatorConfiguration
     */
    protected function paginate(Builder $builder, int $count): PaginatorConfiguration
    {
        return new PaginatorConfiguration($builder, $count);
    }
}