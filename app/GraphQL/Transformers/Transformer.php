<?php
/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\GraphQL\Transformers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Class Transformer
 * @package App\GraphQL\Transformers
 */
abstract class Transformer implements \IteratorAggregate
{
    /**
     * @var Model|Collection
     */
    private $value;

    /**
     * Transformer constructor.
     * @param Model|Collection $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @param Model|Model[]|Collection|null $value
     * @return null|iterable
     * @throws \LogicException
     */
    public static function apply($value): ?iterable
    {
        return (new static($value))->toIterator();
    }

    /**
     * @param Model $model
     * @return iterable
     */
    abstract protected function transform(Model $model): iterable;

    /**
     * @param Model $model
     * @return iterable
     */
    private function transformElement(Model $model): iterable
    {
        return $this->transform($model);
    }

    /**
     * @param iterable $models
     * @return iterable
     */
    private function transformCollection(iterable $models): iterable
    {
        foreach ($models as $model) {
            yield $this->transformElement($model);
        }
    }

    /**
     * @return null|iterable
     * @throws \LogicException
     */
    public function toIterator(): ?iterable
    {
        if ($this->value === null) {
            return $this->value;
        }

        if ($this->value instanceof Model) {
            return $this->transformElement($this->value);
        }

        return $this->transformCollection($this->value);
    }

    /**
     * @return \Traversable
     * @throws \LogicException
     */
    public function getIterator(): \Traversable
    {
        $iterator = $this->toIterator();

        if ($iterator === null) {
            return $iterator;
        }

        yield from $iterator;
    }
}
