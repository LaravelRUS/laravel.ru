<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types = 1);

namespace Service\ImageUploader\Gates;

/**
 * Interface GateInterface.
 */
interface GateInterface
{
    /**
     * @param string $imagePath
     * @return bool
     */
    public function check(string $imagePath): bool;
}
