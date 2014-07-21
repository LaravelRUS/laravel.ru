<?php

$namespace = 'SU\Post\Controllers';

/*
|--------------------------------------------------------------------------
| Routes
|--------------------------------------------------------------------------

*/

Route::get( 'post/example',   ['uses'=>$namespace.'\PostController@getExample',      'as'=>'post.example']);
Route::post('post/example',   ['uses'=>$namespace.'\PostController@postExample',     'as'=>'post.example.save']);

