<?php declare(strict_types=1);
/**
 * This file is part of laravel.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Providers;

use App\Services\ContentRenderer\ContentRenderInterface;
use App\Services\ContentRenderer\MarkdownRenderer;
use cebe\markdown\GithubMarkdown;
use Illuminate\Contracts\Container\Container;
use Illuminate\Support\ServiceProvider;

/**
 * Class MarkdownServiceProvider
 * @package App\Providers
 */
class MarkdownServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(MarkdownRenderer::class, function (Container $app) {
            return new MarkdownRenderer(new GithubMarkdown());
        });

        $this->app->alias(MarkdownRenderer::class, ContentRenderInterface::class);
        $this->app->alias(MarkdownRenderer::class, 'md');
    }
}