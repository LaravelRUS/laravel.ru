<?php declare(strict_types=1);
/**
 * This file is part of laravel.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace App\Services;

/**
 * Class ColorGenerator
 * @package App\Services
 */
class ColorGenerator
{
    /**
     * @param bool $withPrefix
     * @return string
     */
    public function make(bool $withPrefix = true): string
    {
        return ($withPrefix ? '#' : '') .
            strtolower(sprintf('%02X', $this->createDarkColor())) .
            strtolower(sprintf('%02X', $this->createDarkColor())) .
            strtolower(sprintf('%02X', $this->createDarkColor()));
    }

    /**
     * @return int
     */
    private function createDarkColor()
    {
        return random_int(50, 150);
    }
}