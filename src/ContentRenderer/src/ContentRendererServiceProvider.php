<?php

/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Service\ContentRenderer;

use cebe\markdown\Parser;
use cebe\markdown\GithubMarkdown;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\Container\Container;

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
        $this->resolveConfig();

        $this->bindRelations();

        $this->bindContextualRelations($this->app->make(RenderersRepository::class));
    }

    /**
     * @return void
     */
    private function resolveConfig(): void
    {
        $config = __DIR__ . '/../config/renderers.php';

        // Publish config
        $this->publishes([$config => config_path('renderers.php')]);

        // Merge default config
        $this->mergeConfigFrom($config, 'renderers');
    }

    /**
     * @return void
     * @throws \InvalidArgumentException
     */
    private function bindRelations(): void
    {
        // Support
        $this->app->bind(Parser::class, GithubMarkdown::class);

        // Repository with all renderers
        $this->app->singleton(RenderersRepository::class, function (Container $app) {
            $config = $app->make(Repository::class)->get('renderers');

            return new RenderersRepository($app, $config);
        });

        // Register default
        $this->app->singleton(ContentRendererInterface::class, function (Container $app) {
            return $app->make(RenderersRepository::class)->getDefaultRenderer();
        });
    }

    /**
     * @param  RenderersRepository       $repository
     * @throws \InvalidArgumentException
     */
    private function bindContextualRelations(RenderersRepository $repository): void
    {
        foreach ($repository->getContextualBindings() as $context => $relation) {
            $this->app->when($context)->needs(ContentRendererInterface::class)
                ->give(function (Container $app) use ($relation) {
                    return $relation;
                });
        }
    }
}
