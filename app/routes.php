<?php

Route::get("/", "HomeController@getIndex");

Route::controller('test', 'TestController');


