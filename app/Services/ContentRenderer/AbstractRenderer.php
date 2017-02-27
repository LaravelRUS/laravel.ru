<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Services\ContentRenderer;

/**
 * Class Renderer.
 */
abstract class AbstractRenderer implements ContentRenderInterface
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
     * @return $this|ContentRenderInterface
     */
    public function before(\Closure $callback): ContentRenderInterface
    {
        $this->before[] = $callback;

        return $this;
    }

    /**
     * @param  \Closure                     $callback
     * @return $this|ContentRenderInterface
     */
    public function after(\Closure $callback): ContentRenderInterface
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
            $body = $this->parseEventsOutput($body, $before($body));
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
            $body = $this->parseEventsOutput($body, $after($body));
        }

        return $body;
    }

    /**
     * @param  string       $original
     * @param  string|mixed $result
     * @return string
     */
    private function parseEventsOutput(string $original, $result): string
    {
        if (is_string($result)) {
            return $result;
        }

        return $original;
    }
}
