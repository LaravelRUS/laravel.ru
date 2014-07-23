<?php

Route::get("docs/{name?}", 'SU\Docs\Controllers\DocsController@getPage');
