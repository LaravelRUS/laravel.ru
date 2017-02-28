<?php

/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Services\ContentRenderer;

use App\Services\ContentRenderer\Support\HeadersNormalizer;
use cebe\markdown\Parser;

/**
 * Class MarkdownRenderer.
 */
class MarkdownRenderer extends AbstractRenderer
{
    use HeadersNormalizer;

    /**
     * @var Parser
     */
    private $parser;

    /**
     * MarkdownRenderer constructor.
     *
     * @param Parser $parser
     */
    public function __construct(Parser $parser)
    {
        $this->parser = $parser;

        $this->before($this->normalizeHeaders());
    }

    /**
     * @param  string $body
     * @return string
     */
    public function render(string $body): string
    {
        $body = $this->fireBefore($body);

        $body = $this->parser->parse($body);

        return $this->fireAfter($body);
    }
}
