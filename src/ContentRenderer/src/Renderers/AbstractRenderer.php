<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Service\ContentRenderer\Renderers;

use Service\ContentRenderer\ContentRendererInterface;

/**
 * Class Renderer.
 */
abstract class AbstractRenderer implements ContentRendererInterface
{
    private const EVENT_PARSE_BEFORE = 'parse.before';
    private const EVENT_PARSE_AFTER = 'parse.after';

    /**
     * @var array|\Closure[]
     */
    private $before = [];

    /**
     * @var array|\Closure[]
     */
    private $after = [];

    /**
     * @param  \Closure                     $callback
     * @return $this|ContentRendererInterface
     */
    public function before(\Closure $callback): ContentRendererInterface
    {
        $this->before[] = $callback;

        return $this;
    }

    /**
     * @param  \Closure                     $callback
     * @return $this|ContentRendererInterface
     */
    public function after(\Closure $callback): ContentRendererInterface
    {
        $this->after[] = $callback;

        return $this;
    }

    /**
     * @param  string $body
     * @return string
     */
    protected function fireBefore(string $body): string
    {
        foreach ($this->before as $before) {
            if (is_string($parsed = $before($body))) {
                $body = $parsed;
            }
        }

        return $body;
    }

    /**
     * @param  string $body
     * @return string
     */
    protected function fireAfter(string $body): string
    {
        foreach ($this->after as $after) {
            if (is_string($parsed = $after($body))) {
                $body = $parsed;
            }
        }

        return $body;
    }
}
