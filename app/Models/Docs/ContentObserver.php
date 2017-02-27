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
     * @var Parser
     */
    private $parser;

    /**
     * ContentObserver constructor.
     *
     * @param Parser                 $parser
     * @param ContentRenderInterface $renderer
     */
    public function __construct(Parser $parser, ContentRenderInterface $renderer)
    {
        $this->renderer = $renderer;
        $this->parser = $parser;
    }

    /**
     * @param Docs $docs
     */
    public function saving(Docs $docs): void
    {
        $body = $this->render((string) $docs->content_source);

        // Update data
        $docs->nav = $body->getLinks();
        $docs->content_rendered = (string) $body->getContent();
    }

    /**
     * @param string $body
     * @return ProcessedBody
     */
    private function render(string $body): ProcessedBody
    {
        // Parse markdown
        $rendered = $this->renderer->render($body);

        // Parse content headers
        return $this->parser->parse($rendered);
    }
}
