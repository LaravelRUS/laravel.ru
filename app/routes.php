<?php

/**
 * Паттерны параметров роутов
 */
Route::pattern('id', '[0-9]+'); // целое число
Route::pattern('hash', '[a-z0-9]+');
Route::pattern('hex', '[a-f0-9]+');
Route::pattern('uuid', '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}');
Route::pattern('string', '[a-zA-Z0-9]+');
Route::pattern('slug', '[a-z0-9-]+'); // TODO решить, делаем ли кирилические урлы [нет]
//Route::pattern("rus", '[^0-9\p{Cyrillic}]+');

// CSRF Filter on all POST routes
// You MUST use Form::open for forms
// Route::when('*', 'csrf', ['post', 'put', 'patch', 'delete']);

Route::get('/', [
	'as' => 'home',
	'uses' => 'HomeController@home',
]);


/**
 * ===== Хуки гитхаба =====
 */

// Push или pull-request в репозиторий с доками
Route::any('hook/docs_is_updated', [
	'as' => 'hook.docs_is_updated',
	'uses' => 'HookController@docsIsUpdated',
]);


/**
 * ===== Страница cheat sheet =====
 */

Route::get('cheat-sheet', [
	'as' => 'cheat-sheet',
	'uses' => 'PagesController@cheatSheetPage',
]);


/**
 * ===== Авторизация =====
 */

Route::get('registration', [
	'as' => 'auth.registration',
	'uses' => 'AuthController@getRegistration',
]);

Route::post('registration', [
	'as' => 'auth.registration.post',
	'uses' => 'AuthController@postRegistration',
]);

Route::get('registration/almost_done', [
	'as' => 'auth.registration.preconfirmation',
	'uses' => 'AuthController@getPreconfirmation',
]);

Route::get('registration/confirmation/{string}', [
	'as' => 'auth.registration.confirmation',
	'uses' => 'AuthController@getConfirmation',
]);

Route::get('login', [
	'uses' => 'AuthController@getLogin',
	'as' => 'auth.login',
]);

Route::post('login', [
	'uses' => 'AuthController@postLogin',
	'as' => 'auth.login.post',
]);

Route::get('logout', [
	'uses' => 'AuthController@getLogout',
	'as' => 'auth.logout',
]);


/**
 * ===== Админка =====
 */

Route::group(['before' => 'administrator'], function ()
{
	Route::get('admin/list_users', [
		'uses' => 'AdminController@listUsers',
		'as' => 'admin.users',
	]);

	Route::post('admin/add_role', [
		'uses' => 'AdminController@addRole',
		'as' => 'admin.add_role',
	]);

	Route::post('admin/remove_role', [
		'uses' => 'AdminController@removeRole',
		'as' => 'admin.remove_role',
	]);
});


/**
 * ===== Документация =====
 */

Route::get('docs', [
	'as' => 'documentation',
	'uses' => 'DocsController@docs',
]);

Route::group(['before' => 'librarians'], function ()
{
	Route::get('documentation/terms', [
		'uses' => 'TermController@listTerms',
		'as' => 'terms',
	]);

	Route::get('documentation/term/create', [
		'uses' => 'TermController@create',
		'as' => 'term.create',
	]);

	Route::get('documentation/term/{id}/edit', [
		'uses' => 'TermController@edit',
		'as' => 'term.edit',
	]);

	Route::post('documentation/term/store', [
		'uses' => 'TermController@store',
		'as' => 'term.store',
	]);

	Route::get('documentation/updates', [
		'uses' => 'DocsController@updates',
		'as' => 'documentation.updates',
	]);
});

Route::get('documentation/term/{id}', [
	'as' => 'term.popup',
	'uses' => 'TermController@popup',
]);

Route::get('docs/{version}/{string?}', [
	'as' => 'docs',
	'uses' => 'DocsController@docs',
]);


/**
 * ===== Профайл пользователя =====
 */

Route::get('user/{string}', [
	'as' => 'user.profile',
	'uses' => 'UserController@profile',
]);

Route::get('user/{string}/articles', [
	'as' => 'user.articles',
	'uses' => 'UserController@articles',
]);

Route::get('user/{string}/tips', [
	'as' => 'user.tips',
	'uses' => 'UserController@tips',
]);

Route::group(['before' => 'auth'], function ()
{
	// Внутренний профайл пользователя (настройки, смена пароля и т.п.)
	Route::get('settings', [
		'as' => 'user.edit',
		'uses' => 'UserController@edit',
	]);
});


/**
 * ===== Новости =====
 */

Route::get('news', [
	'as' => 'news',
	'uses' => 'NewsController@all',
]);

Route::group(['before' => 'logged'], function ()
{
	Route::get('news/create', [
		'as' => 'news.create',
		'uses' => 'NewsController@create',
	]);

	Route::get('news/edit/{id}', [
		'as' => 'news.edit',
		'uses' => 'NewsController@edit',
	]);

	Route::post('news/save', [
		'as' => 'news.store',
		'uses' => 'NewsController@store',
	]);
});


/**
 * ===== Посты =====
 */

// лента последних постов
Route::get('feed', [
	'as' => 'feed',
	'uses' => 'PostController@feed',
]);

Route::get('content/{slug}', [
	'as' => 'post.view',
	'uses' => 'PostController@show',
]);

Route::group(['before' => 'auth'], function ()
{
	Route::get('content/{slug}/edit/', [
		'as' => 'post.edit',
		'uses' => 'PostController@edit',
	]);

	Route::get('posts/create', [
		'as' => 'post.create',
		'uses' => 'PostController@create',
	]);

	Route::post('posts/store', [
		'as' => 'post.store',
		'uses' => 'PostController@store',
	]);
});


/**
 * ===== "А знаете ли вы что" - советы
 */

Route::group(['before' => 'auth'], function ()
{
	Route::get('tip/{id}/edit/', [
		'as' => 'tips.edit',
		'uses' => 'TipsController@edit',
	]);

	Route::get('tips/create', [
		'as' => 'tips.create',
		'uses' => 'TipsController@create',
	]);

	Route::post('tips/store', [
		'as' => 'tips.store',
		'uses' => 'TipsController@store',
	]);
});


// Тестовый контроллер
Route::controller('test', 'TestController');

//Route::get("{any}", 'HomeController@home');
