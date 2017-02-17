<?php

/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

use Illuminate\Routing\Router;

/** @var Router $router */

$router->pattern('id', '[0-9]+');

$router->get('/', 'HomeController@index')->name('home');

$router->group(['namespace' => 'Auth'], function (Router $router) {
    $router->group(['middleware' => ['guest']], function (Router $router) {
        $router->get('login', 'LoginController@index')->name('login');
        $router->post('login', 'LoginController@login');

        $router->get('register', 'RegistrationController@index')->name('registration');
        $router->post('register', 'RegistrationController@register');
    });

    $router->group(['middleware' => ['auth']], function (Router $router) {
        $router->match(['GET', 'POST'], 'logout', 'LoginController@logout')->name('logout');
        $router->get('confirmed', 'ConfirmationController@index')->name('confirmation.confirmed');

        $router->get('confirm/{token}', 'ConfirmationController@confirm')
            ->where('token', '[a-zA-Z0-9\._]+')
            ->name('confirmation.confirm');
    });
});


// ======== ARTICLES ===========


$router->get('articles', 'ArticlesController@index')
    ->name('articles');

// TODO
$router->get('articles/{slug}', 'ArticlesController@show')
    ->name('article');

// TODO
$router->get('articles/tag/{id}', 'ArticlesController@indexForTag')
    ->name('tag');
