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
use Illuminate\Database\Eloquent\Builder;
use App\GraphQL\Queries\Support\QueryLimit;
use App\GraphQL\Queries\Support\WhereInSelection;

/**
 * Class AbstractQuery.
 */
abstract class AbstractQuery extends Query
{
    use QueryLimit;
    use HasValidation;
    use WhereInSelection;

    /**
     * @return array
     */
    final public function args(): array
    {
        $args = $this->queryArguments();

        $args = $this->argumentsWithLimit($args);
        $args = $this->argumentsWithWhereIn($args);

        return $args;
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

        $query = $this->queryWithLimit($query, $args);
        $query = $this->queryWithWhereIn($query, $args);

        foreach ($args as $field => $value) {
            $query = $query->where($field, $value);
        }

        return $query;
    }
}
