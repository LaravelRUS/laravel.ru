<?php

/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Services\ContentRenderer;

use cebe\markdown\Parser;

/**
 * Class MarkdownRenderer
 *
 * @package App\Services\ContentRenderer
 */
class MarkdownRenderer implements ContentRenderInterface
{
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
    }

    /**
     * @param string $original
     *
     * @return string
     */
    public function renderBody(string $original): string
    {
        return $this->parser->parse($original);
    }
}
