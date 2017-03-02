<?php

/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Service\ContentRenderer\Renderers;

/**
 * Class RawTextRenderer.
 */
class RawTextRenderer extends MarkdownRenderer
{
    /**
     * @param  string $body
     * @return string
     */
    public function render(string $body): string
    {
        $result = parent::render($body);

        $result = $this->removeDisallowedTags($result);

        return $result;
    }

    /**
     * @param  string $body
     * @return string
     */
    private function removeDisallowedTags(string $body): string
    {
        $tags = [
            'b', 'strong',      // bold
            'i', 'em',          // italic
            'ul', 'li', 'ol',   // list
            'a',                // link
            'code', 'pre',       // code
        ];

        $tags = array_map(function (string $tag) {
            return "<${tag}>";
        }, $tags);

        return strip_tags($body, implode('', $tags));
    }
}
