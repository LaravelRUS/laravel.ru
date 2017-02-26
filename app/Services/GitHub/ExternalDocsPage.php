<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Services\GitHub;

use Illuminate\Contracts\Support\Arrayable;

/**
 * Class ExternalDocsPage.
 */
class ExternalDocsPage implements Arrayable
{
    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $content;

    /**
     * ExternalDocsPage constructor.
     * @param string $url
     * @param string $content
     */
    public function __construct(string $url, string $content)
    {
        $this->url = $url;
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'url'     => $this->url,
            'content' => $this->content,
        ];
    }
}