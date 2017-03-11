<?php

/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

use Illuminate\Routing\Router;
use Service\WebSocket\Io\WebSocketRequest as Request;

/* @var Router $router */
$router->options('graphql', function () {
    return new \Illuminate\Http\Response();
});

$router->match(Request::METHOD_WS, '/', '\Folklore\GraphQL\GraphQLController@query');
//
