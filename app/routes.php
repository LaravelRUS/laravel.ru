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
//Route::pattern("rus", '[^0-9\p{Cyrillic}]+');

// CSRF Filter on all POST routes
// You MUST use Form::open for forms
Route::when('*', 'csrf', ['post', 'put', 'patch', 'delete']);

Route::get( '/',                        ['uses' => 'HomeController@home',               'as' => 'home']);
Route::controller( 'test',  "TestController");


// ===== Авторизация =====

Route::get( 'registration',             ['uses'=>'AuthController@getRegistration',      'as'=>'auth.registration']);
Route::post('registration',             ['uses'=>'AuthController@postRegistration',     'as'=>'auth.registration.post']);

Route::get( 'registration/done',        ['uses'=>'AuthController@getConfirmation',      'as'=>'auth.registration.confirmation']);

Route::get( 'login',                    ['uses'=>'AuthController@getLogin',             'as'=>'auth.login']);
Route::post('login',                    ['uses'=>'AuthController@postLogin',            'as'=>'auth.login.post']);

Route::get( 'logout',                   ['uses'=>'AuthController@getLogout',            'as'=>'auth.logout']);

// ===== Новости =====

Route::group(['before'=>'logged'], function(){
	Route::get( 'news/create',                  ['uses'=>'NewsController@create',               'as'=>'news.create']);
	Route::get( 'news/edit/{id}',               ['uses'=>'NewsController@edit',                 'as'=>'news.edit']);
	Route::post('news/save',                    ['uses'=>'NewsController@store',                'as'=>'news.store']);

});
Route::get( 'news',                     ['uses'=>'NewsController@all',                  'as'=>'news']);

// ===== Админка =====

Route::group(['before'=>'administrator'], function() {

	Route::get( 'admin/list_users',             ['uses'=>'AdminController@listUsers',               'as'=>'admin.users']);
	Route::post('admin/add_role',               ['uses'=>'AdminController@addRole',                 'as'=>'admin.add_role']);
	Route::post('admin/remove_role',            ['uses'=>'AdminController@removeRole',              'as'=>'admin.remove_role']);

});

// ===== Документация

Route::group(['before'=>'librarians'], function() {
	Route::get( 'documentation/terms',                    ['uses'=>'TermController@listTerms',             'as'=>'terms']);
	Route::get( 'documentation/term/create',                    ['uses'=>'TermController@create',             'as'=>'term.create']);
	Route::get( 'documentation/term/{id}/edit',                    ['uses'=>'TermController@edit',             'as'=>'term.edit']);
	Route::post('documentation/term/store',                    ['uses'=>'TermController@store',             'as'=>'term.store']);

	Route::get( 'documentation/updates',                    ['uses'=>'DocsController@updates',             'as'=>'documentation.updates']);
});
Route::get( 'documentation/term/{id}',                    ['uses'=>'TermController@popup',             'as'=>'term.popup']);

Route::get( 'docs',                              ['uses'=>'DocsController@docs',             'as'=>'documentation']);
Route::get( 'docs/{version}/{string?}',          ['uses'=>'DocsController@docs',              'as'=>'docs']);

// ===== Блог пользователя

Route::get( 'user/{string}',            ['uses'=>'UserController@profile',                 'as'=>'user.profile']);
Route::get( 'user/{string}/blog',            ['uses'=>'BlogController@blog',                 'as'=>'user.blog']);

// ===== Отображение поста

Route::get( 'post/{slug}',              ['uses' => 'PostController@show',               'as' => 'post.view']);

Route::group(['before'=>'auth'], function() {

	// Создание/редактирование постов
	Route::get( 'post/{slug}/edit/',    ['uses' => 'PostController@edit',               'as' => 'post.edit']);
	Route::get( 'posts/create',          ['uses' => 'PostController@create',             'as' => 'post.create']);
	Route::post('posts/store',           ['uses' => 'PostController@store',              'as' => 'post.store']);

	// Внутренний профайл пользователя (настройки, смена пароля и т.п.)
	Route::get('settings',               ['uses' => 'UserController@edit',            'as' => 'user.edit']);

});

//Route::get("{any}", 'HomeController@home');



