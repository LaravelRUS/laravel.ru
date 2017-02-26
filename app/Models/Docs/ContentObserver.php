<?php

/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Models\Docs;

use App\Models\Docs;
use App\Services\ContentRenderer\ContentRenderInterface;

/**
 * Class ContentObserver.
 */
class ContentObserver
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
     * @param Docs $docs
     */
    public function saving(Docs $docs): void
    {
        $rendered = $this->renderer->renderBody((string) $docs->content_source);

        $docs->content_rendered = (string) $rendered;
    }
}
