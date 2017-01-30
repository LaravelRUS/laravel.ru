<?php declare(strict_types=1);
/**
 * This file is part of laravel.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Illuminate\Routing\Router;

/** @var Router $router */

$router->get('/', 'HomeController@index')->name('home');

$router->group(['namespace' => 'Auth'], function (Router $router) {
    $router->get('login', 'LoginController@index')->name('login');
    $router->post('login', 'LoginController@login');

    // TODO: logout нынче принято делать методом post
    $router->get('logout', 'LoginController@logout')->name('logout');

    $router->get('register', 'RegistrationController@index')->name('registration');
    $router->post('register', 'RegistrationController@register');

    $router->get('confirmed', 'ConfirmationController@index')->name('confirmation.confirmed');

    $router->get('confirm/{id}/{token}', 'ConfirmationController@confirm')
        ->where('id', '[0-9]+')
        ->where('token', '[a-zA-Z0-9=]+')
        ->name('confirmation.confirm');
});
