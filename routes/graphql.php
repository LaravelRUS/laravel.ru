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

use App\GraphQL\Decorators\VersionDecorator;
use Railt\Routing\Router;
use App\GraphQL\Decorators\DateTimeDecorator;
use App\GraphQL\Controllers\DocsVersionsController;
use App\GraphQL\Controllers\DocsProjectsController;


/**
 * Controllers
 */
//$router->group('.', function(Router $router) {
    $router->on('project', DocsProjectsController::class . '@show');
    $router->on('projects', DocsProjectsController::class . '@index');

    $router->group('project|projects', function (Router $router) {
        $router->on('versions', DocsVersionsController::class . '@index');

    });
//});


/**
 * Decorators
 */
$router->on('*{timestamps}', DateTimeDecorator::class . '@parseFormatArgument')
    ->where('timestamps', 'createdAt|updatedAt');

$router->on('*.versions.version', VersionDecorator::class . '@formatVersion');
