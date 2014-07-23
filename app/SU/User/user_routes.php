<?php

/*
|--------------------------------------------------------------------------
| Routes
|--------------------------------------------------------------------------

*/

Route::get( 'registration',   ['uses'=>'SU\User\Controllers\AuthController@getRegistration',      'as'=>'auth.registration']);
Route::post('registration',   ['uses'=>'SU\User\Controllers\AuthController@postRegistration',     'as'=>'auth.registration.post']);

Route::get( 'registration/confirmation',   ['uses'=>'SU\User\Controllers\AuthController@getConfirmation',      'as'=>'auth.registration.confirmation']);

Route::get( 'login',          ['uses'=>'SU\User\Controllers\AuthController@getLogin',             'as'=>'auth.login']);
Route::post('login',          ['uses'=>'SU\User\Controllers\AuthController@postLogin',            'as'=>'auth.login.post']);

Route::get( 'logout',         ['uses'=>'SU\User\Controllers\AuthController@getLogout',             'as'=>'auth.logout']);

Route::group(['before'=>'auth'], function() {
	Route::get('profile', ['uses' => 'SU\User\Controllers\UserController@profile', 'as' => 'user.profile']);
});



