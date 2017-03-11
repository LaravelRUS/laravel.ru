<?php

/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Models\Tip;

use App\Models\Tip;
use Service\ContentRenderer\ContentRendererInterface;

/**
 * Class ContentObserver.
 */
class ContentObserver
{
    /**
     * @var ContentRendererInterface
     */
    private $renderer;

    /**
     * ContentObserver constructor.
     *
     * @param ContentRendererInterface $renderer
     */
    public function __construct(ContentRendererInterface $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * @param Tip $tip
     */
    public function saving(Tip $tip): void
    {
        if ($tip->content_source) {
            $rendered = $this->renderer->render($tip->content_source);

            $tip->content_rendered = $rendered;
        }
    }
}
