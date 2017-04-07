<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\GraphQL\Feature\Kernel;

use Illuminate\Support\Str;
use GraphQL\Type\Definition\Type;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class FeaturesSupport
 * @package App\GraphQL\Feature\Kernel
 */
trait FeaturesSupport
{
    use AttributeExists;

    /**
     * @var array
     */
    private $args = [];

    /**
     * @var array|\Closure[]
     */
    private $fieldsWrapper = [];

    /**
     * @var array|\Closure[]
     */
    private $queries = [];

    /**
     * @param string $name
     * @param Type $type
     * @param string|null $description
     * @return $this
     */
    public function addArgument(string $name, Type $type, string $description = null)
    {
        $this->args[$name] = [
            'type'        => $type,
            'description' => $description ?? Str::ucfirst($name) . ' field of ' . get_class($this),
        ];

        return $this;
    }

    /**
     * @param \Closure $wrapper
     * @return $this
     */
    public function addFieldsWrapper(\Closure $wrapper)
    {
        $this->fieldsWrapper[] = $wrapper;

        return $this;
    }

    /**
     * @param \Closure $resolveQuery
     * @return $this
     */
    public function addQuery(\Closure $resolveQuery)
    {
        $this->queries[] = $resolveQuery;

        return $this;
    }

    /**
     * @param string $argument
     * @param \Closure $resolveQuery
     * @return $this
     */
    public function addQueryFor(string $argument, \Closure $resolveQuery)
    {
        $this->queries[] = function(Builder $builder, array $args = []) use ($argument, $resolveQuery) {
            return $this->whenExists($args, $argument, function ($value) use ($builder, $resolveQuery) {
                return $resolveQuery($builder, $value);
            }) ?? $builder;
        };

        return $this;
    }

    /**
     * @return void
     */
    protected function boot(): void
    {
        $this->bootTraits();
    }

    /**
     * @return void
     */
    protected function bootTraits(): void
    {
        foreach (class_uses_recursive(static::class) as $trait) {
            if (method_exists($this, $method = 'boot' . class_basename($trait))) {
                call_user_func([$this, $method]);
            }
        }
    }

    /**
     * @param array $arguments
     * @return array
     */
    protected function extendArguments(array $arguments = []): array
    {
        return array_merge($arguments, $this->args);
    }

    /**
     * @param array $fields
     * @return array
     */
    protected function extendFields(array $fields = []): array
    {
        foreach ($this->fieldsWrapper as $wrapper) {
            $fields = $wrapper($fields);

            if ($fields instanceof \Iterator) {
                $fields = iterator_to_array($fields);
            }
        }

        return $fields;
    }

    /**
     * @param Builder $builder
     * @param array $args
     * @return Builder|mixed
     */
    protected function extendQuery(Builder $builder, array $args)
    {
        foreach ($this->queries as $query) {
            $builder = $query($builder, $args);
        }

        return $builder;
    }
}