<?php

/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Providers;

use cebe\markdown\GithubMarkdown;
use Illuminate\Support\ServiceProvider;
use App\Services\ContentRenderer\MarkdownRenderer;
use App\Services\ContentRenderer\ContentRenderInterface;

class MarkdownServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(MarkdownRenderer::class, function () {
            return new MarkdownRenderer(new GithubMarkdown());
        });

        $this->app->alias(MarkdownRenderer::class, ContentRenderInterface::class);
        $this->app->alias(MarkdownRenderer::class, 'md');
    }
}
