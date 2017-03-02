<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types = 1);

namespace Service\ContentRenderer;

/**
 * Interface ContentRenderInterface.
 */
interface ContentRendererInterface
{
    /**
     * @param  \Closure                     $callback
     * @return $this|ContentRendererInterface
     */
    public function before(\Closure $callback): ContentRendererInterface;

    /**
     * @param  string $original
     * @return string
     */
    public function render(string $original): string;

    /**
     * @param  \Closure                     $callback
     * @return $this|ContentRendererInterface
     */
    public function after(\Closure $callback): ContentRendererInterface;
}
