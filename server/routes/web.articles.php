<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);
/*
|--------------------------------------------------------------------------
| Articles
|--------------------------------------------------------------------------
|
| TODO Add description
|
*/

use Illuminate\Routing\Router;

/* @var Router $router */

$router->get('articles', 'ArticlesController@index')
    ->name('articles');

// TODO
$router->get('articles/{slug}', 'ArticlesController@show')
    ->name('articles.show');

// TODO
$router->get('articles/tag/{id}', 'ArticlesController@indexForTag')
    ->name('tag');
