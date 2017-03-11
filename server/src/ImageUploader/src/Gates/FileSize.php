<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Service\ImageUploader\Gates;

/**
 * Class FileSize.
 */
class FileSize implements GateInterface
{
    /**
     * max = 1000 -> (b) -> 1000 -> (kb) -> 20 (mb).
     */
    private const SIZE_MAX = 1000 * 1000 * 20;

    /**
     * 2 bytes min? Why not? %).
     */
    private const SIZE_MIN = 2;

    /**
     * @var int
     */
    private $maxSize;

    /**
     * @var int
     */
    private $minSize;

    /**
     * FileSize constructor.
     *
     * @param int $maxSize
     * @param int $minSize
     */
    public function __construct(int $maxSize = self::SIZE_MAX, int $minSize = self::SIZE_MIN)
    {
        $this->maxSize = $maxSize;
        $this->minSize = $minSize;
    }

    /**
     * @param  string               $imagePath
     * @return bool
     * @throws \OutOfRangeException
     */
    public function check(string $imagePath): bool
    {
        $currentSize = filesize($imagePath);

        if ($currentSize > $this->maxSize || $currentSize < $this->minSize) {
            $message = 'Image size (%sb) are out of range [%s...%s]';
            throw new \OutOfRangeException(sprintf($message, $currentSize, $this->minSize, $this->maxSize));
        }

        return true;
    }
}
