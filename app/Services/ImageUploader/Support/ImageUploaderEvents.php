<?php
/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Services\ImageUploader\Support;

use App\Services\ImageUploader\ImageUploaderInterface;

/**
 * Class ImageUploaderEvents.
 *
 * @mixin ImageUploaderInterface
 */
trait ImageUploaderEvents
{
    /**
     * @var array|\Closure[]
     */
    private $beforeCallbacks = [];

    /**
     * @var array|\Closure[]
     */
    private $afterCallbacks = [];

    /**
     * @param  \Closure               $callback
     * @return ImageUploaderInterface
     */
    public function before(\Closure $callback): ImageUploaderInterface
    {
        $this->beforeCallbacks[] = $callback;

        return $this;
    }

    /**
     * @param  \Closure               $callback
     * @return ImageUploaderInterface
     */
    public function after(\Closure $callback): ImageUploaderInterface
    {
        $this->afterCallbacks[] = $callback;

        return $this;
    }

    /**
     * @param array|mixed[] ...$data
     */
    protected function fireBefore(...$data): void
    {
        foreach ($this->beforeCallbacks as $callback) {
            $callback(...$data);
        }
    }

    /**
     * @param array|mixed[] ...$data
     */
    protected function fireAfter(...$data): void
    {
        foreach ($this->afterCallbacks as $callback) {
            $callback(...$data);
        }
    }
}
