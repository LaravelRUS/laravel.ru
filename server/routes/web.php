<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

use Illuminate\Routing\Router;

/* @var Router $router */

$router->pattern('id', '[0-9]+');

$router->get('/', 'HomeController@index')->name('home');

// TODO
$router->get('/react/{path?}', 'HomeController@react');

require __DIR__ . '/web.auth.php';
require __DIR__ . '/web.articles.php';
require __DIR__ . '/web.docs.php';
