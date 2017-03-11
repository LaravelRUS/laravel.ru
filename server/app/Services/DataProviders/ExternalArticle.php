<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Services\DataProviders;

use Carbon\Carbon;
use App\Models\Article;
use Illuminate\Contracts\Support\Arrayable;

/**
 * Class ExternalArticle.
 */
class ExternalArticle implements Arrayable
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $body;

    /**
     * @var string
     */
    private $preview = '';

    /**
     * @var string
     */
    private $url;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var array|string[]
     */
    private $images = [];

    /**
     * ExternalArticle constructor.
     * @param string $title
     * @param string $body
     * @param string $url
     */
    public function __construct(string $title, string $body, string $url)
    {
        $this->title = $title;
        $this->body = $body;
        $this->url = $url;

        $this->createdAt = Carbon::now();
    }

    /**
     * @return string
     */
    public function getPreview(): string
    {
        return $this->preview;
    }

    /**
     * @param  string                $preview
     * @return $this|ExternalArticle
     */
    public function setPreview(string $preview): ExternalArticle
    {
        $this->preview = $preview;

        return $this;
    }

    /**
     * @param  string $image
     * @return $this
     */
    public function addImageUrl(string $image)
    {
        $this->images[] = $image;

        return $this;
    }

    /**
     * @return array
     */
    public function getImages(): array
    {
        return [];
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param  \DateTime             $createdAt
     * @return $this|ExternalArticle
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'title'      => $this->title,
            'url'        => $this->url,
            'images'     => $this->images,
            'content'    => $this->body,
            'created_at' => $this->createdAt,
        ];
    }

    /**
     * @param  Article $article
     * @return Article
     */
    public function fill(Article $article): Article
    {
        $article->title = $this->title;
        //$article-
        $article->image = reset($this->images);

        $article->preview_source = '';
        $article->preview_rendered = $this->preview;

        $article->content_source = '';
        $article->content_rendered = $this->body;

        $article->published_at = $this->createdAt;

        $article->status = Article\Status::PUBLISHED;

        return $article;
    }
}
