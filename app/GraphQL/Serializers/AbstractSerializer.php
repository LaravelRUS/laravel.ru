<?php

/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\GraphQL\Serializers;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AbstractSerializer.
 */
abstract class AbstractSerializer
{
    /**
     * @param  Collection|Model[]|null $collection
     * @return Collection
     */
    public static function collection(?Collection $collection): Collection
    {
        if ($collection === null) {
            return new Collection();
        }

        return $collection->map(static::map());
    }

    /**
     * @param  Model|null $model
     * @return array
     */
    public static function serialize(?Model $model): array
    {
        if ($model === null) {
            return [];
        }

        return app(static::class)->toArray($model);
    }

    /**
     * @return \Closure
     */
    public static function map(): \Closure
    {
        return function (Model $model) {
            return static::serialize($model);
        };
    }

    /**
     * @param  Model $model
     * @return array
     */
    public function toArray(Model $model): array
    {
        return $model->toArray();
    }

    /**
     * @param \DateTime|null $date
     * @return string
     */
    protected function formatDateTime(?\DateTime $date): string
    {
        if ($date === null) {
            $date = Carbon::now();
        }

        return $date->format(Carbon::RFC3339);
    }
}
