<?php
/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Models\Article\ContentObserver;

use Illuminate\Support\Str;

/**
 * Class ContentHeadersRenderer.
 */
class ContentHeadersRenderer
{
    /**
     * @var string
     */
    private $body;

    /**
     * @var array
     */
    private $links = [];

    /**
     * @var string
     */
    private $content = '';

    /**
     * @var array
     */
    private $tags = [
        'h6' => 'h6',
        'h5' => 'h6',
        'h4' => 'h5',
        'h3' => 'h4',
        'h2' => 'h3',
        'h1' => 'h2',
    ];

    /**
     * HeadersPrerender constructor.
     *
     * @param string $body
     */
    public function __construct(string $body)
    {
        $this->body = $body;
    }

    /**
     * @return ContentHeadersRenderer
     */
    public function parse(): ContentHeadersRenderer
    {
        $this->links = [];

        $this->content = preg_replace_callback('/<(h\d+)>(.*?)<\/h\d+>/isu', function ($data) {
            list($data, $tag, $header) = $data;
            $id = Str::slug($header);

            foreach ($this->tags as $from => $to) {
                $tag = str_replace($from, $to, $tag);
            }

            $this->links[] = [
                'anchor' => $id,
                'title'  => $header,
                'level'  => $tag,
            ];

            $link = '<%s><a href="#%s" class="anchor" name="%s"></a>%s</%s>';

            return sprintf($link, $tag, $id, $id, $header, $tag);
        }, $this->body);

        return $this;
    }

    /**
     * @return array
     */
    public function getLinks(): array
    {
        return $this->links;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }
}
