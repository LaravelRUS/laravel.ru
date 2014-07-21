<?php

Route::get("/", function(){
	return View::make('home');
});




Route::get("docs/{name?}", 'SU\Docs\Controllers\DocsController@getPage');

Route::controller('test', 'TestController');