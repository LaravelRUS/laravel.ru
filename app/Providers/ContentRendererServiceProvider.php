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
use App\Models\Docs\ContentObserver;
use Illuminate\Support\ServiceProvider;
use App\Services\ContentRenderer\RawTextRenderer;
use App\Services\ContentRenderer\MarkdownRenderer;
use App\Services\ContentRenderer\LaravelDocsRenderer;
use App\Services\ContentRenderer\ContentRenderInterface;

/**
 * Class ContentRendererServiceProvider.
 */
class ContentRendererServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register(): void
    {
        $this->registerDefaultBehaviour();

        // Documentation renderer
        $this->app->when(ContentObserver::class)
            ->needs(ContentRenderInterface::class)
            ->give(function () {
                return new LaravelDocsRenderer(new GithubMarkdown());
            });

        // Tips content renderer
        $this->app->when(RawTextRenderer::class)
            ->needs(ContentRenderInterface::class)
            ->give(function () {
                return new RawTextRenderer(new GithubMarkdown());
            });
    }

    /**
     * @return void
     */
    private function registerDefaultBehaviour()
    {
        $this->app->singleton(MarkdownRenderer::class, function () {
            return new MarkdownRenderer(new GithubMarkdown());
        });

        $this->app->alias(MarkdownRenderer::class, ContentRenderInterface::class);
        $this->app->alias(MarkdownRenderer::class, 'md');
    }
}
