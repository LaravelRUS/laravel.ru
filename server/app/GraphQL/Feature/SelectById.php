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

/**
 * Class SelectById
 * @package App\GraphQL\Feature
 * @mixin FeaturesSupport
 */
trait SelectById
{
    /**
     * @return void
     */
    protected function bootSelectById()
    {
        $this->addArgument('id', Type::listOf(Type::id()));

        $this->addQueryFor('id', function (Builder $builder, array $ids) {
            return $builder->whereIn('id', $ids);
        });
    }
}