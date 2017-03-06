<?php

/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Models\DocsPage;

use App\Models\DocsPage;
use Service\ContentRenderer\Anchors\Parser;
use Service\ContentRenderer\RenderersRepository;
use Service\ContentRenderer\Anchors\ProcessedBody;
use Service\ContentRenderer\ContentRendererInterface;

/**
 * Class ContentObserver.
 */
class ContentObserver
{
    /**
     * @var Parser
     */
    private $parser;

    /**
     * @var RenderersRepository
     */
    private $repository;

    /**
     * ContentObserver constructor.
     * @param Parser              $parser
     * @param RenderersRepository $repository
     */
    public function __construct(Parser $parser, RenderersRepository $repository)
    {
        $this->parser = $parser;
        $this->repository = $repository;
    }

    /**
     * @param  DocsPage                  $page
     * @throws \InvalidArgumentException
     */
    public function saving(DocsPage $page): void
    {
        $body = $this->render($this->getRenderer($page), (string) $page->content_source);

        // Update data
        $page->nav = $body->getLinks();
        $page->content_rendered = (string) $body->getContent();
    }

    /**
     * @param  DocsPage                  $page
     * @return ContentRendererInterface
     * @throws \InvalidArgumentException
     */
    private function getRenderer(DocsPage $page): ContentRendererInterface
    {
        return $this->repository->getRenderer($page->docs->renderer);
    }

    /**
     * @param  ContentRendererInterface $renderer
     * @param  string                   $body
     * @return ProcessedBody
     */
    private function render(ContentRendererInterface $renderer, string $body): ProcessedBody
    {
        // Parse markdown
        $rendered = $renderer->render($body);

        // Parse content headers
        return $this->parser->parse($rendered);
    }
}
