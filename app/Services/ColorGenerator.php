<?php

/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Services;

class ColorGenerator
{
    public function make(bool $withPrefix = true): string
    {
        return ($withPrefix ? '#' : '').
            strtolower(sprintf('%02X', $this->createDarkColor())).
            strtolower(sprintf('%02X', $this->createDarkColor())).
            strtolower(sprintf('%02X', $this->createDarkColor()));
    }

    private function createDarkColor(): int
    {
        return random_int(50, 150);
    }
}
