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
use Illuminate\Support\Str;

/**
 * Class ContentPreviewObserver
 */
class ContentPreviewObserver
{
    /**
     * @var ContentRenderInterface
     */
    private $renderer;

    /**
     * ContentObserver constructor.
     *
     * @param ContentRenderInterface $renderer
     */
    public function __construct(ContentRenderInterface $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * @param Article $article
     */
    public function saving(Article $article): void
    {
        if (! $article->preview_source) {
            $article->preview_source = Str::words($article->content_source, 100, '…');
        }

        $article->preview_rendered = $this->renderer->renderBody($article->preview_source);
    }
}
