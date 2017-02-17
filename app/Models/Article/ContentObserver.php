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
use App\Services\ContentRenderer\ContentRenderInterface;

class ContentObserver
{
    /** @var ContentRenderInterface */
    private $renderer;

    public function __construct(ContentRenderInterface $renderer)
    {
        $this->renderer = $renderer;
    }

    public function saving(Article $article): void
    {
        if ($article->content_source) {
            $article->content_rendered = $this->renderer->renderBody($article->content_source);
        }
    }
}
