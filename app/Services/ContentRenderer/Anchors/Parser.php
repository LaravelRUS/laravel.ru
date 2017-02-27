<?php
/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Services\ContentRenderer\Anchors;

use Illuminate\Support\Str;

/**
 * Class Parser.
 */
class Parser
{
    /**
     * @param  string        $body
     * @return ProcessedBody
     */
    public function parse(string $body): ProcessedBody
    {
        $links = [];

        $body = preg_replace_callback('/<(h\d+)>(.*?)<\/h\d+>/isu', function ($data) use (&$links) {
            list($data, $tag, $header) = $data;

            $id = $this->createAnchorName($header);

            $links[] = new AnchorLink($id, $header, $tag);

            return $this->render($tag, $id, $header);
        }, $body);

        return new ProcessedBody($body, $links);
    }

    /**
     * @param  string $title
     * @return string
     */
    private function createAnchorName(string $title): string
    {
        return Str::slug($title);
    }

    /**
     * @param  string $tag
     * @param  string $id
     * @param  string $header
     * @return string
     */
    private function render(string $tag, string $id, string $header): string
    {
        $link = '<%s><a href="#%s" class="anchor" name="%s"></a>%s</%s>';

        return sprintf($link, $tag, $id, $id, $header, $tag);
    }
}
