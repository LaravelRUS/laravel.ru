<?php
/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Service\ImageUploader;

use Http\Promise\Promise;
use Illuminate\Contracts\Filesystem\Filesystem;
use Service\ImageUploader\Gates\GateInterface;
use Service\ImageUploader\Resolvers\ImageResolverInterface;

/**
 * Interface ImageUploaderInterface.
 */
interface ImageUploaderInterface
{
    /**
     * @param  int|null               $width
     * @param  int|null               $height
     * @return ImageUploaderInterface
     */
    public function withSize(?int $width, ?int $height): ImageUploaderInterface;

    /**
     * @param GateInterface $gate
     * @return ImageUploaderInterface
     */
    public function satisfy(GateInterface $gate): ImageUploaderInterface;

    /**
     * @param  \Closure               $callback
     * @return ImageUploaderInterface
     */
    public function before(\Closure $callback): ImageUploaderInterface;

    /**
     * @param  \Closure               $callback
     * @return ImageUploaderInterface
     */
    public function after(\Closure $callback): ImageUploaderInterface;

    /**
     * @param  Filesystem                  $fs
     * @param  ImageResolverInterface|null $path
     * @param  bool                        $removeTemp
     * @return Promise
     */
    public function upload(Filesystem $fs, ImageResolverInterface $path = null, bool $removeTemp = true): Promise;

    /**
     * @param array ...$options
     * @return ImageResolverInterface
     */
    public function getDefaultResolver(...$options): ImageResolverInterface;
}
