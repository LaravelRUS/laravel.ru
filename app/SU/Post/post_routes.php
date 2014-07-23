<?php

/*
|--------------------------------------------------------------------------
| Routes
|--------------------------------------------------------------------------

*/
Route::group(['before'=>'auth'], function() {

	Route::get( 'post/create',      ['uses' => 'SU\Post\Controllers\PostController@create',     'as' => 'post.create']);
	Route::post('post/store',       ['uses' => 'SU\Post\Controllers\PostController@store',      'as' => 'post.store']);
	Route::post('post/{id}/edit/',  ['uses' => 'SU\Post\Controllers\PostController@edit',       'as' => 'post.edit']);

});