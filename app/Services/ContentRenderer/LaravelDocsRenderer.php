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

        // Remove unused content (headers and nav)
        $this->before($this->removeDocumentTitle());
        $this->before($this->removeLeadingNavigation());

        // Remove custom quotes
        $this->before($this->removeTipQuotes());
        $this->before($this->removeNoteQuotes());

        // Force hide anchors
        $this->before($this->hideExternalAnchors());

        // Cross-page navigation
        $this->before($this->fixDocsNavigationLinks());
    }

    /**
     * Исправляет ссылки в документации "/docs/{version}/..."
     *
     * TODO Надо это не забыть реализовать =)
     *
     * @return \Closure
     */
    private function fixDocsNavigationLinks(): \Closure
    {
        return function (string $body) {
            return $body;
        };
    }

    /**
     * Удаляет из исходного текста все вхождения "> {tip}"
     *
     * @return \Closure
     */
    private function removeTipQuotes(): \Closure
    {
        return function (string $body) {
            return preg_replace('/>\s+{\s*tip\s*}\s+/iu', '> ', $body);
        };
    }

    /**
     * Удаляет навигацию из начала документа
     *
     * @return \Closure
     */
    private function removeLeadingNavigation(): \Closure
    {
        return function (string $body) {
            /**
             * TODO This expression are vulnerable: ReDoS-based exploit. Probably we can improve and fix it?
             *
             * @see https://en.wikipedia.org/wiki/ReDoS
             */
            return preg_replace('/^(?:[\n\s]*\-.*?\n)+/isu', '', $body);
        };
    }

    /**
     * Удаляет из исходного текста все вхождения "> {note}"
     *
     * @return \Closure
     */
    private function removeNoteQuotes(): \Closure
    {
        return function (string $body) {
            return preg_replace('/>\s+{\s*note\s*}\s+/iu', '> ', $body);
        };
    }

    /**
     * Скрывает из исходного текста все вхождения "<a .... name="some">...</a>".
     * Требуется для избежания конфликтов с вёрсткой.
     *
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
     * Удаляет из документа заголовки первого уровня, находящиеся в самом начале статьи
     *
     * @return \Closure
     */
    private function removeDocumentTitle(): \Closure
    {
        return function (string $body) {
            return preg_replace('/^[\s\n]+?#\s+?.*?\n/isu', '', $body);
        };
    }
}
