<?php

/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Models\Article;

use App\Models\Article;
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
     * @param Article $article
     */
    public function saving(Article $article): void
    {
        if ($article->content_rendered && ! $article->content_source) {
            return;
        }

        $rendered = $this->renderer->render((string) $article->content_source);

        $article->content_rendered = (string) $rendered;
    }
}
