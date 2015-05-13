<?php

/**
 * Паттерны параметров роутов
 */
Route::pattern('id', '[0-9]+');
Route::pattern('hash', '[a-z0-9]+');
Route::pattern('hex', '[a-f0-9]+');
Route::pattern('uuid', '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}');
Route::pattern('string', '[a-zA-Z0-9]+');
Route::pattern('username', '^\b[a-zA-Z\pN\-\_\.]+\b$');
Route::pattern('slug', '[a-z0-9-]+');

// CSRF Filter on all POST routes
// You MUST use Form::open for forms
// Route::when('*', 'csrf', ['post', 'put', 'patch', 'delete']);

// ===== Главная страница
Route::get('/', [
	'as' => 'home',
	'uses' => 'HomeController@home'
]);

// ===== Хуки гитхаба

// Push или pull-request в репозиторий с доками
Route::post('hook/docs_is_updated', [
	'as' => 'hook.docs_is_updated',
	'uses' => 'HookController@docsIsUpdated',
]);

Route::post('hook/push_to_develop', [
	'as' => 'hook.push_to_develop',
	'uses' => 'HookController@pushToDevelop',
]);

// ===== Страница cheat sheet
Route::get('cheat-sheet', ['uses' => 'PagesController@cheatSheetPage', 'as' => 'cheat-sheet']);

// ===== Дополнительная информация
Route::group(['prefix' => 'help'], function ()
{
	Route::get('rules', [
		'as' => 'pages.rules',
		'uses' => 'PagesController@rulesPage',
	]);

	Route::get('{slug}', [
		'as' => 'page',
		'uses' => 'PagesController@page',
	]);
});

// ===== Регистрация, авторизация
Route::group(['before' => 'guest'], function ()
{
	Route::get('registration', [
		'as' => 'auth.registration',
		'uses' => 'AuthController@registration'
	]);

	Route::post('registration', [
		'as' => 'auth.registration.post',
		'uses' => 'AuthController@submitRegistration'
	]);

	Route::get('registration/almost-done', [
		'as' => 'auth.registration.pre-confirmation',
		'uses' => 'AuthController@preConfirmation'
	]);

	Route::get('registration/confirmation/{string}', [
		'as' => 'auth.registration.confirmation',
		'uses' => 'AuthController@checkConfirmation'
	]);

	Route::get('login', [
		'as' => 'auth.login',
		'uses' => 'AuthController@login'
	]);

	Route::post('login', [
		'as' => 'auth.login.post',
		'uses' => 'AuthController@submitLogin'
	]);
});

// ===== Выход
Route::get('logout', [
	'as' => 'auth.logout',
	'uses' => 'AuthController@logout'
]);

// ===== Документация

Route::group(['prefix' => 'docs/sleepingowl_admin'], function ()
{
	Route::get('{name?}', [
		'as' => 'documentation.sleepingowl_admin',
		'uses' => 'DocsSleepingowlAdminController@docs'
	]);
});

Route::group(['prefix' => 'docs'], function ()
{
	Route::get('status', [
		'as' => 'documentation.status',
		'uses' => 'DocsController@status'
	]);

	Route::get('{version?}/{string?}', [
		'as' => 'documentation',
		'uses' => 'DocsController@docs'
	])->where('version', '\d\.\d');
});



// ===== Профайл пользователя
Route::group(['before' => 'auth'], function ()
{
	// Загрузка аватара
	Route::post('settings/avatar-upload', [
		'as' => 'user.avatar',
		'uses' => 'UserController@changeAvatar',
	]);

	// Удаление аватара
	Route::delete('settings/avatar-delete', [
		'as' => 'user.avatar.delete',
		'uses' => 'UserController@deleteAvatar',
	]);

	// Внутренний профайл пользователя (настройки, смена пароля и т.п.)
	Route::get('settings', ['uses' => 'UserController@edit', 'as' => 'user.edit']);
	Route::post('settings', ['uses' => 'UserController@update']);

	// Изменение пароля
	Route::get('settings/change-password', [
		'uses' => 'ChangePasswordController@getForm',
		'as' => 'user.change-password'
	]);
	Route::post('settings/change-password', ['uses' => 'ChangePasswordController@postForm']);

	// Изменение Email
	Route::get('settings/change-email', [
		'uses' => 'ChangeEmailController@getForm',
		'as' => 'user.change-email'
	]);
	Route::post('settings/change-email', ['uses' => 'ChangeEmailController@postForm']);
});

// ===== Список пользователей
Route::group(['prefix' => 'users'], function ()
{
	Route::get('{status?}', [
		'as' => 'users',
		'uses' => 'UsersController@index',
	])->where('status', 'online|offline');

	Route::get('{group}', [
		'as' => 'users.group',
		'uses' => 'UsersController@group',
	])->where('group', 'administrators|moderators|librarians');
});

// ===== Сброс пароля
Route::group(['prefix' => 'password'], function ()
{
	Route::get('remind', 'RemindersController@getRemind');
	Route::post('remind', 'RemindersController@postRemind');

	Route::get('reset', 'RemindersController@getReset');
	Route::post('reset', 'RemindersController@postReset');
});

// ===== Новости
Route::get('news', ['uses' => 'NewsController@all', 'as' => 'news']);

Route::group(['prefix' => 'news', 'before' => 'logged'], function ()
{
	Route::get('create', ['uses' => 'NewsController@create', 'as' => 'news.create']);
	Route::get('edit/{id}', ['uses' => 'NewsController@edit', 'as' => 'news.edit']);
	Route::post('save', ['uses' => 'NewsController@store', 'as' => 'news.store']);
});

// ===== Articles
Route::get('articles', [
	'as' => 'articles.all',
	'uses' => 'ArticlesController@showAll'
]);

Route::group(['before' => 'auth'], function ()
{
	Route::get('content/{id}/edit/', ['uses' => 'ArticleController@edit', 'as' => 'articles.edit']);
	Route::get('articles/create', [
		'as' => 'articles.create',
		'uses' => 'ArticlesController@create'
	]);
	Route::get('articles/edit/{id}', [
		'as' => 'articles.edit',
		'uses' => 'ArticlesController@edit'
	]);
	Route::post('articles/store', [
		'as' => 'articles.store',
		'uses' => 'ArticlesController@store'
	]);
});

Route::get('articles/{slug}', [
	'as' => 'articles.show',
	'uses' => 'ArticlesController@show'
]);

// ===== "А знаете ли вы что" - советы
Route::group(['before' => 'auth'], function ()
{
	Route::get('tip/{id}/edit/', ['uses' => 'TipsController@edit', 'as' => 'tips.edit']);
	Route::get('tips/create', ['uses' => 'TipsController@create', 'as' => 'tips.create']);
	Route::post('tips/store', ['uses' => 'TipsController@store', 'as' => 'tips.store']);
});

// ===== Комментарии
Route::group(['before' => 'auth|csrf'], function ()
{
	Route::post('comment/store', ['uses' => 'CommentController@store', 'as' => 'comment.store']);
});

// ===== Admin
Route::group(['prefix' => 'admin', 'before' => 'admin', 'namespace' => 'Admin'], function ()
{
	// Управление пользователями
	Route::resource('users', 'UsersController', [
		'names' => [
			'index' => 'admin.users'
		]
	]);

	// Управление статьями
	Route::resource('articles', 'ArticlesController');

	// Управление запрещенными статьями
	Route::resource('restricted-words', 'RestrictedWordsController');

	// Управление ролями пользователя
	Route::post('add_role', [
		'uses' => 'RolesController@store',
		'as' => 'admin.add_role',
	]);

	Route::post('remove_role', [
		'uses' => 'RolesController@destroy',
		'as' => 'admin.remove_role',
	]);
});

// ===== Профайл пользователя
Route::group(['prefix' => '{username}'], function ()
{
	Route::get('/', ['uses' => 'UserController@profile', 'as' => 'user.profile']);
	Route::get('articles', ['uses' => 'UserController@articles', 'as' => 'user.articles']);
	Route::get('tips', ['uses' => 'UserController@tips', 'as' => 'user.tips']);
});
