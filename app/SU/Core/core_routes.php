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

Route::get( '/',        ['uses' => 'SU\Core\Controllers\HomeController@home',     'as' => 'home']);


Route::controller('test', 'TestController');