<?php

/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Models\Article;

use App\Models\Article;
use App\Services\ContentRenderer\ContentRenderInterface;
use App\Services\ContentRenderer\ContentHeadersRenderer;

/**
 * Class ContentObserver.
 */
class ContentObserver
{
    /**
     * @var ContentRenderInterface
     */
    private $renderer;

    /**
     * ContentObserver constructor.
     *
     * @param ContentRenderInterface $renderer
     */
    public function __construct(ContentRenderInterface $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * @param Article $article
     */
    public function saving(Article $article): void
    {
        if ($article->content_rendered && ! $article->content_source) {
            return;
        }

        $rendered = $this->renderer->renderBody((string) $article->content_source);

        $rendered = $this->parseHeaders($rendered);

        $article->content_rendered = (string) $rendered->getContent();
    }

    /**
     * @param  string                 $content
     * @return ContentHeadersRenderer
     */
    private function parseHeaders(string $content): ContentHeadersRenderer
    {
        return (new ContentHeadersRenderer($content))->parse();
    }
}
