<?php

/*
|--------------------------------------------------------------------------
| Routes
|--------------------------------------------------------------------------

*/
Route::group(['before'=>'auth'], function() {

	Route::get( 'post/create',        ['uses' => 'SU\Post\Controllers\PostController@create',     'as' => 'post.create']);
	Route::get( 'post/{slug}/edit/',  ['uses' => 'SU\Post\Controllers\PostController@edit',       'as' => 'post.edit']);
	Route::post('post/store',         ['uses' => 'SU\Post\Controllers\PostController@store',      'as' => 'post.store']);

});

Route::get( 'post/{slug}',  ['uses' => 'SU\Post\Controllers\PostController@show',       'as' => 'post.view']);