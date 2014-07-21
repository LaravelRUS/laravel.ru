<?php

$namespace = 'SU\User\Controllers';

/*
|--------------------------------------------------------------------------
| Routes
|--------------------------------------------------------------------------

*/

//Route::get( 'user/example',   ['uses'=>$namespace.'\UserController@getExample',      'as'=>'user.example']);
//Route::post('user/example',   ['uses'=>$namespace.'\UserController@postExample',     'as'=>'user.example.save']);

Route::get( 'registration',   ['uses'=>$namespace.'\AuthController@getRegistration',      'as'=>'auth.registration']);
Route::post('registration',   ['uses'=>$namespace.'\AuthController@postRegistration',     'as'=>'auth.registration.post']);

Route::get( 'registration/confirmation',   ['uses'=>$namespace.'\AuthController@getConfirmation',      'as'=>'auth.registration.confirmation']);

Route::get( 'login',          ['uses'=>$namespace.'\AuthController@getLogin',             'as'=>'auth.login']);
Route::post('login',          ['uses'=>$namespace.'\AuthController@postLogin',            'as'=>'auth.login.post']);

Route::get( 'logout',         ['uses'=>$namespace.'\AuthController@getLogout',             'as'=>'auth.logout']);

Route::get( 'profile',        ['uses'=>$namespace.'\UserController@profile',            'as'=>'user.profile']);
