<?php
/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types = 1);

namespace App\Services\ContentRenderer;

use Illuminate\Events\Dispatcher;

/**
 * Class Renderer.
 */
abstract class AbstractRenderer implements ContentRenderInterface
{
    private const EVENT_PARSE_BEFORE = 'parse.before';
    private const EVENT_PARSE_AFTER  = 'parse.after';

    /**
     * @var Dispatcher
     */
    private $events;

    /**
     * AbstractRenderer constructor.
     */
    public function __construct()
    {
        $this->events = new Dispatcher();
    }

    /**
     * @param \Closure $callback
     * @return $this|ContentRenderInterface
     */
    public function before(\Closure $callback): ContentRenderInterface
    {
        $this->events->listen(self::EVENT_PARSE_BEFORE, $callback);

        return $this;
    }

    /**
     * @param \Closure $callback
     * @return $this|ContentRenderInterface
     */
    public function after(\Closure $callback): ContentRenderInterface
    {
        $this->events->listen(self::EVENT_PARSE_AFTER, $callback);

        return $this;
    }

    /**
     * @param string $body
     * @return string
     */
    protected function fireBefore(string $body): string
    {
        $result = (array)$this->events->fire(self::EVENT_PARSE_BEFORE, [$body]);

        if (count($result) >= 1) {
            return reset($result);
        }

        return $body;
    }

    /**
     * @param string $body
     * @return string
     */
    protected function fireAfter(string $body): string
    {
        $result = (array)$this->events->fire(self::EVENT_PARSE_AFTER, [$body]);

        if (count($result) >= 1) {
            return reset($result);
        }

        return $body;
    }
}
