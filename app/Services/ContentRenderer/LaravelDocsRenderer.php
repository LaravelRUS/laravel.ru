<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types = 1);

namespace App\Services\ContentRenderer;

use cebe\markdown\Parser;

/**
 * Class LaravelDocsRenderer.
 */
class LaravelDocsRenderer extends MarkdownRenderer
{
    /**
     * LaravelDocsRenderer constructor.
     *
     * @param Parser $parser
     */
    public function __construct(Parser $parser)
    {
        parent::__construct($parser);

        $this->after(function ($body) {
            return 23;
        });
    }
}
