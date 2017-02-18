<?php

/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\GraphQL\Serializers;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractSerializer
{
    /**
     * @param  Collection|Model[]  $collection
     *
     * @return Collection
     */
    public static function collection(Collection $collection): Collection
    {
        return $collection->map(static::map());
    }

    public static function serialize(Model $model): array
    {
        return app(static::class)->toArray($model);
    }

    public static function map(): \Closure
    {
        return function (Model $model) {
            return static::serialize($model);
        };
    }

    public function toArray(Model $model): array
    {
        return $model->toArray();
    }
}
