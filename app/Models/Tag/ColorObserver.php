<?php

/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Models\Tag;

use App\Models\Tag;
use App\Services\ColorGenerator;

class ColorObserver
{
    /** @var ColorGenerator */
    private $color;

    public function __construct(ColorGenerator $color)
    {
        $this->color = $color;
    }

    public function creating(Tag $tag)
    {
        if ($tag->color === null) {
            $tag->updateColor($this->color);
        }
    }
}
