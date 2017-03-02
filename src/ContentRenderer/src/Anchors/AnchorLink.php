<?php
/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Service\ContentRenderer\Anchors;

use Illuminate\Contracts\Support\Arrayable;

/**
 * Class AnchorLink.
 */
class AnchorLink implements Arrayable
{
    /**
     * @var string
     */
    private $anchor;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $level;

    /**
     * AnchorLink constructor.
     *
     * @param string $anchor
     * @param string $title
     * @param string $level
     */
    public function __construct(string $anchor, string $title, string $level)
    {
        $this->anchor = $anchor;
        $this->title = $title;
        $this->level = $level;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'anchor' => $this->anchor,
            'title'  => $this->title,
            'level'  => $this->level,
        ];
    }
}
