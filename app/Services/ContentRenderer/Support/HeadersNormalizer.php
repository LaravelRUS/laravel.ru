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
     * @var int
     */
    private $maxHeaderLevel = 2;

    /**
     * @var int
     */
    private $minHeaderLevel = 6;

    /**
     * @var string
     */
    private $pattern = '/^(#+)\s+(.*?)\s*$/mius';

    /**
     * @return \Closure
     */
    protected function normalizeHeaders(): \Closure
    {
        return function (string $body) {
            $delta = $this->getMaxHeaderLevel($body) - $this->maxHeaderLevel;

            return preg_replace_callback('/^(#+)\s+(.*?)\s*$/mius', function (array $matches) use ($delta) {
                [$body, $tag, $title] = $matches;

                $level = $this->mdTagToLevel($tag);
                $level += $delta;
                $level = min($this->minHeaderLevel, max($this->maxHeaderLevel, $level));

                return str_repeat('#', $level) . ' ' . $title;
            }, $body);
        };
    }

    /**
     * @param  string    $body
     * @return int|mixed
     */
    private function getMaxHeaderLevel(string $body)
    {
        $max = $this->minHeaderLevel;

        preg_match_all($this->pattern, $body, $matches);

        for ($i = 0, $len = count($matches[0]); $i < $len; $i++) {
            $max = min($max, $this->mdTagToLevel($matches[1][$i]));
        }

        return $max;
    }

    /**
     * @param  string $tag
     * @return int
     */
    private function mdTagToLevel(string $tag): int
    {
        $level = strlen(trim($tag));

        return max(1, min($this->minHeaderLevel, $level));
    }
}
