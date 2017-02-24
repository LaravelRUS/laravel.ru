<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Services\DataProviders;

use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Collection;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Class LaravelNewsDataProvider.
 */
class LaravelNewsDataProvider implements DataProviderInterface
{
    private const CONTENT_NAMESPACE = 'http://purl.org/rss/1.0/modules/content/';
    private const FEED_URL = 'https://feed.laravel-news.com';

    /**
     * @var Client
     */
    private $client;

    /**
     * LaravelNewsDataProvider constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param  \DateTime                    $latest
     * @return Collection|ExternalArticle[]
     * @throws \RuntimeException
     */
    public function getLatest(\DateTime $latest): Collection
    {
        $result = new Collection();

        foreach ($this->getArticles() as $article) {
            if ($article->getCreatedAt() < $latest) {
                break;
            }

            $result->push($article);
        }

        return $result;
    }

    /**
     * @return \Generator|ExternalArticle[]
     * @throws \RuntimeException
     */
    private function getArticles(): \Generator
    {
        $response = $this->client->get(self::FEED_URL);

        $body = $response->getBody();

        yield from $this->parseBody((string) $body);
    }

    /**
     * @param  string            $body
     * @return \Generator
     * @throws \RuntimeException
     */
    private function parseBody(string $body): \Generator
    {
        $parser = new Crawler($body);

        /** @var \DOMElement $node */
        foreach ($parser->filter('rss > channel > item') as $node) {
            $parsed = $this->parseContent(
                $node->getElementsByTagNameNS(self::CONTENT_NAMESPACE, '*')
                    ->item(0)
                    ->textContent
            );

            ['images' => $images, 'body' => $content] = $parsed;

            $article = new ExternalArticle(
                (string) $this->getContentOf($node, 'title'),
                trim($content),
                (string) $this->getContentOf($node, 'link')
            );

            foreach ($images as $image) {
                $article->addImageUrl($image);
            }

            $article->setCreatedAt(Carbon::parse(
                (string) $this->getContentOf($node, 'pubDate')
            ));

            yield $article;
        }
    }

    /**
     * @param  string $body
     * @return array
     */
    private function parseContent(string $body): array
    {
        $images = [];

        $pattern = '/<img.+?src\s*=\s*"(.*?)".+?>/isu';
        preg_match_all($pattern, $body, $matches);

        for ($i = 0, $len = count($matches[0]); $i < $len; $i++) {
            $images[] = $matches[1][$i] ?? null;
            $body = str_replace($matches[0][$i] ?? '', '', $body);
        }

        return ['images' => $images, 'body' => $body];
    }

    /**
     * @param  \DOMElement $root
     * @param  string      $tagName
     * @return null|string
     */
    private function getContentOf(\DOMElement $root, string $tagName): ?string
    {
        $node = $root->getElementsByTagName($tagName);

        if ($node->length >= 1) {
            return $node->item(0)->textContent;
        }
    }
}
