<?php
/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Services\ImageUploader;

use Http\Promise\Promise;
use Illuminate\Contracts\Filesystem\Filesystem;
use App\Services\ImageUploader\Resolvers\ImageResolverInterface;

/**
 * Interface ImageUploaderInterface.
 */
interface ImageUploaderInterface
{
    /**
     * @param int|null $width
     * @param int|null $height
     * @return ImageUploaderInterface
     */
    public function withSize(?int $width, ?int $height): ImageUploaderInterface;

    /**
     * @param \Closure $callback
     * @return ImageUploaderInterface
     */
    public function before(\Closure $callback): ImageUploaderInterface;

    /**
     * @param \Closure $callback
     * @return ImageUploaderInterface
     */
    public function after(\Closure $callback): ImageUploaderInterface;

    /**
     * @param ImageResolverInterface $resolver
     * @param Filesystem             $fs
     * @param bool                   $removeTempFile
     * @return Promise
     */
    public function upload(ImageResolverInterface $resolver, Filesystem $fs, bool $removeTempFile = true): Promise;
}
