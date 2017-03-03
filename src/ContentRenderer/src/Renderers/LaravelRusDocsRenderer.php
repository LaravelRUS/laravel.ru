<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Service\ContentRenderer\Renderers;

use cebe\markdown\Parser;

/**
 * Class LaravelRusDocsRenderer.
 */
class LaravelRusDocsRenderer extends LaravelDocsRenderer
{
    /**
     * LaravelRusDocsRenderer constructor.
     * @param Parser $parser
     */
    public function __construct(Parser $parser)
    {
        $this->before($this->removeGitCommit());

        parent::__construct($parser);
    }

    /**
     * Удаляет из документа ссылку на "git commit hash", находящиеся в самом начале статьи.
     * @return \Closure
     */
    private function removeGitCommit(): \Closure
    {
        return function (string $body) {
            return preg_replace('/^git\s+[a-z0-9]+\n+[\-]+\n/isu', '', $body);
        };
    }
}
