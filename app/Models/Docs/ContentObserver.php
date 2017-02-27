<?php

/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Models\Docs;

use App\Models\Docs;
use App\Services\ContentRenderer\Anchors\Parser;
use App\Services\ContentRenderer\Anchors\ProcessedBody;
use App\Services\ContentRenderer\ContentRenderInterface;

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
     * @param Docs $docs
     */
    public function saving(Docs $docs): void
    {
        // Parse markdown
        $rendered = $this->renderer->render((string) $docs->content_source);

        // Parse content headers
        $parsed = $this->parseHeaders($rendered);

        // Update data
        $docs->nav = $parsed->getLinks();
        $docs->content_rendered = (string) $parsed->getContent();
    }

    /**
     * @param  string $content
     * @return ProcessedBody
     */
    private function parseHeaders(string $content): ProcessedBody
    {
        return (new Parser())->parse($content);
    }
}
