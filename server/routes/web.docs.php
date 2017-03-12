<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);
/*
|--------------------------------------------------------------------------
| Docs
|--------------------------------------------------------------------------
|
| TODO Add description
|
*/

use Illuminate\Routing\Router;

/* @var Router $router */

$router->get('docs', 'DocsController@index')->name('docs');

$router->get('docs/{version}/{slug}', 'DocsController@show')->name('docs.show');
