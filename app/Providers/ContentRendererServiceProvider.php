<?php

/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Providers;

use cebe\markdown\Parser;
use cebe\markdown\GithubMarkdown;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\Container\Container;
use App\Services\ContentRenderer\RawTextRenderer;
use App\Services\ContentRenderer\RenderersRepository;
use App\Services\ContentRenderer\ContentRenderInterface;

/**
 * Class ContentRendererServiceProvider.
 */
class ContentRendererServiceProvider extends ServiceProvider
{
    /**
     * @return void
     * @throws \InvalidArgumentException
     */
    public function register(): void
    {
        // Support
        $this->app->bind(Parser::class, GithubMarkdown::class);


        // Repository with all renderers
        $this->app->singleton(RenderersRepository::class, function (Container $app) {
            $config = $app->make(Repository::class)->get('renderers');

            return new RenderersRepository($app, $config);
        });


        // Register default
        $this->app->singleton(ContentRenderInterface::class, function (Container $app) {
            return $app->make(RenderersRepository::class)->getDefaultRenderer();
        });


        // Tips content renderer
        $this->app->when(RawTextRenderer::class)
            ->needs(ContentRenderInterface::class)
            ->give(function () {
                return $this->app->make(RenderersRepository::class)
                    ->getRenderer('raw');
            });
    }
}
