<?php

/**
 * Паттерны параметров роутов
 */
Route::pattern('id',     '[0-9]+'); // целое число
Route::pattern('hash',   '[a-z0-9]+');
Route::pattern('hex',    '[a-f0-9]+');
Route::pattern('uuid',   '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}');
Route::pattern('string', '[a-zA-Z0-9]+');
Route::pattern('slug',   '[a-z0-9-]+'); // TODO решить, делаем ли кирилические урлы

// CSRF Filter on all POST routes
// You MUST use Form::open for forms
Route::when('*', 'csrf', ['post', 'put', 'patch', 'delete']);

Route::get( '/',                        ['uses' => 'HomeController@home',               'as' => 'home']);

// ===== Авторизация =====

Route::get( 'registration',             ['uses'=>'AuthController@getRegistration',      'as'=>'auth.registration']);
Route::post('registration',             ['uses'=>'AuthController@postRegistration',     'as'=>'auth.registration.post']);

Route::get( 'registration/done',        ['uses'=>'AuthController@getConfirmation',      'as'=>'auth.registration.confirmation']);

Route::get( 'login',                    ['uses'=>'AuthController@getLogin',             'as'=>'auth.login']);
Route::post('login',                    ['uses'=>'AuthController@postLogin',            'as'=>'auth.login.post']);

Route::get( 'logout',                   ['uses'=>'AuthController@getLogout',            'as'=>'auth.logout']);

// ===== Документация

Route::get("{version}/docs/{string?}",            ['uses'=>'DocsController@getPage',              'as'=>'doc']);

// ===== Блог пользователя

Route::get( 'user/{string}',            ['uses'=>'BlogController@blog',                 'as'=>'user.blog']);

// ===== Отображение поста

Route::get( 'post/{slug}',              ['uses' => 'PostController@show',               'as' => 'post.view']);

Route::group(['before'=>'auth'], function() {

	// Создание/редактирование постов
	Route::get( 'post/{slug}/edit/',    ['uses' => 'PostController@edit',               'as' => 'post.edit']);
	Route::get( 'posts/create',          ['uses' => 'PostController@create',             'as' => 'post.create']);
	Route::post('posts/store',           ['uses' => 'PostController@store',              'as' => 'post.store']);

	// Внутренний профайл пользователя (настройки, смена пароля и т.п.)
	Route::get('profile',               ['uses' => 'UserController@profile',            'as' => 'user.profile']);

});

Route::get("{any}", 'HomeController@home');



