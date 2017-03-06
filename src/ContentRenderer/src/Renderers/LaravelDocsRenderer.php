<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Service\ContentRenderer\Renderers;

use cebe\markdown\Parser;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;

/**
 * Class LaravelDocsRenderer.
 */
class LaravelDocsRenderer extends MarkdownRenderer
{
    /**
     * LaravelDocsRenderer constructor.
     * @param Parser $parser
     */
    public function __construct(Parser $parser)
    {
        // Remove unused content (headers and nav)
        $this->before($this->removeDocumentTitle());
        $this->before($this->removeLeadingNavigation());

        // Force hide anchors
        $this->before($this->hideExternalAnchors());

        // Cross-page navigation
        $this->before($this->fixDocsNavigationLinks());

        // Internal code
        $this->before($this->removeInternalStyles());
        $this->before($this->updateInternalNavigation());

        // Move "{tip}" and "{note}" to class
        $this->after($this->parseQuotes());

        parent::__construct($parser);
    }

    /**
     * Удаляет из документа заголовки первого уровня, находящиеся в самом начале статьи.
     * @return \Closure
     */
    private function removeDocumentTitle(): \Closure
    {
        return function (string $body) {
            return preg_replace('/^[\s\n]*?#\s+?.*?\n/isu', '', $body);
        };
    }

    /**
     * Удаляет навигацию из начала документа.
     * @return \Closure
     */
    private function removeLeadingNavigation(): \Closure
    {
        return function (string $body) {
            /**
             * TODO This expression are vulnerable: ReDoS-based exploit. Probably we can improve and fix it?
             * @see https://en.wikipedia.org/wiki/ReDoS
             */
            return preg_replace('/^(?:[\n\s]*\-.*?\n)+/isu', '', $body);
        };
    }

    /**
     * Скрывает из исходного текста все вхождения "<a .... name="some">...</a>".
     * Требуется для избежания конфликтов с вёрсткой.
     * @return \Closure
     */
    private function hideExternalAnchors(): \Closure
    {
        $replacement = '<a href="#" style="display: none;" name="$1"></a>';

        return function (string $body) use ($replacement) {
            return preg_replace('/<a.+?name="(.*?)".*?>.*?<\/a>/isu', $replacement, $body);
        };
    }

    /**
     * Исправляет ссылки в документации "/docs/{version}/...".
     * TODO Надо это не забыть реализовать =).
     * @return \Closure
     */
    private function fixDocsNavigationLinks(): \Closure
    {
        return function (string $body) {
            return $body;
        };
    }

    /**
     * @return \Closure
     */
    private function removeInternalStyles(): \Closure
    {
        return function (string $body) {
            return preg_replace('/<style>.*?<\/style>/isu', '', $body);
        };
    }

    /**
     * @return \Closure
     */
    private function updateInternalNavigation(): \Closure
    {
        $pattern = '/<div\s+class="[\w\-\s0-9]+"\s+markdown="1"\s*>\n*(.*?)\n*<\/div>/isu';

        return function (string $body) use ($pattern) {
            return preg_replace_callback($pattern, function ($args) {
                $result = (new Collection(explode("\n", $args[1] ?? '')))
                    ->filter(function (string $line) {
                        return trim($line);
                    })
                    ->map(function (string $line) {
                        $line = trim($line);

                        return Str::startsWith($line, '- ') ? $line : '- ' . $line;
                    })
                    ->implode("\n");

                return "\n${result}\n";
            }, $body);
        };
    }

    /**
     * Заменяет все вхождения вида "> {tip}" на "<blockquote class="quote-tip">".
     * @return \Closure
     */
    private function parseQuotes(): \Closure
    {
        $pattern = '/<blockquote>\s*<p>\s*{([a-z]+)}\s*(.*?)<\/p>\s*<\/blockquote>/isu';

        return function (string $body) use ($pattern) {
            return preg_replace(
                $pattern,
                '<blockquote class="quote-$1"><p>$2</p></blockquote>',
                $body
            );
        };
    }
}
