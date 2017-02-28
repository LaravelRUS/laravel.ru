<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Services\ContentRenderer\Support;

/**
 * Class HeadersNormalizer.
 */
trait HeadersNormalizer
{
    /**
     * @var array
     */
    private $tags = [
        6 => 6,
        5 => 6,
        4 => 5,
        3 => 4,
        2 => 3,
        1 => 2,
    ];

    /**
     * @return \Closure
     */
    protected function normalizeHeaders(): \Closure
    {
        return function (string $body) {
            return preg_replace_callback('/^(#+)\s+(.*?)\s*$/mius', function (array $matches) {
                [$body, $level, $title] = $matches;

                $size = $this->tags[
                    max(1, min(6, strlen($level)))
                ];

                return str_repeat('#', $size) . ' ' . $title;
            }, $body);
        };
    }
}