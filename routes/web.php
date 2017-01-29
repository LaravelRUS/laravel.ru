<?php declare(strict_types=1);
/**
 * This file is part of laravel.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index')->name('home');



Route::middleware('guest')->group(function () {
    Route::get('/login', 'AuthController@index')->name('login');
    Route::post('/login', 'AuthController@login')->name('login.action');

    Route::get('/register', 'RegistrationController@index')->name('registration');
    Route::post('/register', 'RegistrationController@register')->name('registration.action');
});

Route::middleware('auth')->group(function () {
    Route::get('/logout', 'AuthController@logout')->name('logout');
});


