<?php

//Route::get("docs", "SU\\Docs\\Controllers\\DocsController@getPage");
Route::get("docs/{name?}", "SU\\Docs\\Controllers\\DocsController@getPage");