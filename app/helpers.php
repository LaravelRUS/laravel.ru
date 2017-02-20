<?php

/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

if (! function_exists('asset_ts')) {
    /**
     * Asset path with timestamp.
     *
     * @param string $path
     * @param string $directory
     *
     * @return string
     */
    function asset_ts(string $path = '', string $directory = 'dist/'): string
    {
        $link = '/' . $directory . $path;

        return $link . '?' . (
            is_file(public_path($link))
                ? filemtime(public_path($link))
                : random_int(0, 9999)
            );
    }
}
