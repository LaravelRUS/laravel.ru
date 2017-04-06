<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\GraphQL\Queries;

use Folklore\GraphQL\Support\Query;
use App\GraphQL\Kernel\HasValidation;
use Illuminate\Database\Eloquent\Model;
use App\GraphQL\Kernel\AttributeExists;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class AbstractQuery.
 */
abstract class AbstractQuery extends Query
{
    use AttributeExists;
    use HasValidation;

    /**
     * @return array
     */
    public function args(): array
    {
        return $this->queryArguments();
    }

    /**
     * @return array
     */
    abstract protected function queryArguments(): array;

    /**
     * @param string $model
     * @param array  $args
     * @return Builder|Model <T>
     * @internal param $ string|Model|Model<T> $model
     */
    protected function queryFor(string $model, array $args = []): Builder
    {
        $query = $model::query();

        foreach ($args as $field => $value) {
            $query = $query->where($field, $value);
        }

        return $query;
    }
}
