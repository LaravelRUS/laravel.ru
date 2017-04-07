<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\GraphQL\Mutations;

use Folklore\GraphQL\Support\Mutation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\GraphQL\Queries\Support\HasValidation;
use App\GraphQL\Feature\Kernel\FeaturesSupport;

/**
 * Class AbstractMutation.
 */
abstract class AbstractMutation extends Mutation
{
    use HasValidation;
    use FeaturesSupport;

    /**
     * AbstractMutation constructor.
     * @param array $attributes
     */
    public function __construct($attributes = [])
    {
        $this->boot();
        parent::__construct($attributes);
    }

    /**
     * @return array
     */
    public function args(): array
    {
        return $this->extendArguments($this->queryArguments());
    }

    /**
     * @return array
     */
    abstract protected function queryArguments(): array;

    /**
     * @param string|Model $model
     * @param array  $args
     * @return Builder|Model <T>
     */
    protected function queryFor(string $model, array $args = []): Builder
    {
        return $this->extendQuery($model::query(), $args);
    }
}
