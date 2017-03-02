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
use Intervention\Image\Image;
use Http\Promise\RejectedPromise;
use Http\Promise\FulfilledPromise;
use Intervention\Image\Constraint;
use Intervention\Image\ImageManager;
use Illuminate\Contracts\Filesystem\Filesystem;
use Service\ImageUploader\Gates\AccessDeniedGateException;
use Service\ImageUploader\Gates\GateInterface;
use Service\ImageUploader\Support\ImageUploaderEvents;
use Service\ImageUploader\Resolvers\ImageResolverInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

/**
 * Class ImageUploader.
 */
class ImageUploader implements ImageUploaderInterface
{
    /**
     * Image upload helper.
     */
    use ImageUploaderEvents;

    /**
     * Temporary directory (location into storage).
     */
    protected const TEMP_PATH = 'app/public';

    /**
     * @var ImageManager
     */
    protected $image;

    /**
     * @var int
     */
    private $width = 128;

    /**
     * @var int
     */
    private $height = 128;

    /**
     * @var array|GateInterface[]
     */
    private $gates = [];

    /**
     * AvatarUploader constructor.
     *
     * @param ImageManager $manager
     */
    public function __construct(ImageManager $manager)
    {
        $this->image = $manager;
    }

    /**
     * @param GateInterface $gate
     * @return ImageUploaderInterface
     */
    public function satisfy(GateInterface $gate): ImageUploaderInterface
    {
        $this->gates[] = $gate;

        return $this;
    }

    /**
     * @param  int|null                                    $width
     * @param  int|null                                    $height
     * @return $this|AvatarUploader|ImageUploaderInterface
     */
    public function withSize(?int $width, ?int $height): ImageUploaderInterface
    {
        [$this->width, $this->height] = [$width, $height];

        return $this;
    }

    /**
     * @param  ImageResolverInterface|null $resolver
     * @param  Filesystem                  $fs
     * @param  bool                        $removeTemp
     * @return Promise
     *
     * @throws \RuntimeException
     * @throws \Symfony\Component\HttpFoundation\File\Exception\FileException
     */
    public function upload(Filesystem $fs, ImageResolverInterface $resolver = null, bool $removeTemp = true): Promise
    {
        $temp   = $this->getStorageFilename();
        $public = $this->createRelativeFilename();

        try {
            $imagePath = ($resolver ?? $this->getDefaultResolver())->resolve();

            foreach ($this->gates as $gate) {
                try {
                    if ($gate->check($imagePath)) {
                        throw new AccessDeniedGateException($gate, $imagePath);
                    }
                } catch (\Exception $e) {
                    throw new AccessDeniedGateException($gate, $imagePath, $e->getCode(), $e);
                }
            }

            $this->process($imagePath)->save($temp);

            // Publish to cloud storage
            $fs->put($public, file_get_contents($temp));

            if ($removeTemp) {
                $this->removeTemporaryFileOrFail($temp);
            }

            return new FulfilledPromise($public);
        } catch (\Exception $exception) {
            return new RejectedPromise($exception);
        }
    }

    /**
     * @return string
     */
    private function getStorageFilename(): string
    {
        return storage_path(static::TEMP_PATH . '/' . $this->createRandomName());
    }

    /**
     * @return string
     */
    private function createRandomName(): string
    {
        return md5(random_int(0, PHP_INT_MAX) . microtime());
    }

    /**
     * @return string
     */
    private function createRelativeFilename(): string
    {
        $hash = $this->createRandomName();

        return vsprintf('%s/%s/%s.png', [
            substr($hash, 0, 2),
            substr($hash, 2, 2),
            substr($hash, 4),
        ]);
    }

    /**
     * @param  string $filenameOrUrl
     * @return Image
     */
    private function process(string $filenameOrUrl): Image
    {
        $image = $this->image->make($filenameOrUrl);

        $this->fireBefore($image);

        $image->resize($this->width, null, function (Constraint $constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        $image->crop(
            $this->width ?? $image->width(),
            $this->height ?? $image->height()
        );

        $this->fireAfter($image);

        return $image;
    }

    /**
     * @param  string $temporaryFilename
     * @return bool
     *
     * @throws \Symfony\Component\HttpFoundation\File\Exception\FileException
     */
    private function removeTemporaryFileOrFail(string $temporaryFilename): bool
    {
        if (! $this->removeTemporaryFile($temporaryFilename)) {
            throw new FileException("Can not remove temporary file ${temporaryFilename}.");
        }

        return true;
    }

    /**
     * @param  string $temporaryFilename
     * @return bool
     */
    private function removeTemporaryFile(string $temporaryFilename): bool
    {
        return @unlink($temporaryFilename) || ! is_file($temporaryFilename);
    }

    /**
     * @param array ...$options
     * @return ImageResolverInterface
     * @throws \BadMethodCallException
     */
    public function getDefaultResolver(...$options): ImageResolverInterface
    {
        throw new \BadMethodCallException(static::class . ' has no available image resolvers.');
    }
}
