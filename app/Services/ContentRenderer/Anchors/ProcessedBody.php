<?php
/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types = 1);

namespace App\Services\ContentRenderer\Anchors;

/**
 * Class ProcessedBody
 */
class ProcessedBody
{
    /**
     * @var string
     */
    private $body;

    /**
     * @var array|AnchorLink[]
     */
    private $links = [];

    /**
     * ProcessedBody constructor.
     *
     * @param string $body
     * @param array  $links
     */
    public function __construct(string $body, array $links = [])
    {
        $this->body = $body;
        $this->links = $links;
    }

    /**
     * @param AnchorLink $link
     * @return $this|ProcessedBody
     */
    public function addAnchorLink(AnchorLink $link): ProcessedBody
    {
        $this->links[] = $link;

        return $this;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->body;
    }

    /**
     * @return array
     */
    public function getLinks(): array
    {
        $result = [];

        foreach ($this->links as $link) {
            $result[] = $link->toArray();
        }

        return $result;
    }
}
