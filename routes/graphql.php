<?php
/**
 * This file is part of Railt Laravel Adapter package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @var Router $router
 */
declare(strict_types=1);

use Railt\Routing\Router;

/**
 * Controllers
 */
$router->group('.', function (Router $router) {
    $router->on('project', 'DocsProjectsController@show');
    $router->on('projects', 'DocsProjectsController@index');

    $router->group('project|projects', function (Router $router) {
        $router->on('versions', 'DocsVersionsController@index');
    });
})
    ->namespace('App\\GraphQL\\Controllers');


/**
 * Decorators
 */
$router->group('*', function (Router $router) {
    $router->on('{timestamps}', 'DateTimeDecorator@parseFormatArgument')
        ->where('timestamps', 'createdAt|updatedAt');

    $router->on('versions.version', 'VersionDecorator@formatVersion');
})
    ->namespace('App\\GraphQL\\Decorators');
