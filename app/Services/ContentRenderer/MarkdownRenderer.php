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

class MarkdownRenderer implements ContentRenderInterface
{
    /** @var Parser */
    private $parser;

    public function __construct(Parser $parser)
    {
        $this->parser = $parser;
    }

    public function renderBody(string $original): string
    {
        return $this->parser->parse($original);
    }
}
