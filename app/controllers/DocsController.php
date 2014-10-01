<?php

use LaravelRU\Docs\DocsUtil;

class DocsController extends BaseController {

	public function __construct()
	{
		
	}

	public function defaultDocs($name = "installation")
	{
        $default_version = Config::get("laravel.default_version");
        return Redirect::route("docs", [$default_version, $name]);
	}

	public function docs($version = "", $name = "installation")
	{
		if( ! in_array($version, Config::get("laravel.versions"))){
			// Запрошен универсальный урл типа /docs/installation - средиректить на /docs/5.0/installation
			$default_version = Config::get("laravel.default_version");
			return Redirect::route("docs", [$default_version, $version]);
		}

		$page = Docs::version($version)->name($name)->first();
		$menu = Docs::version($version)->name("menu")->first();

		return View::make("docs/docpage", ['page'=>$page, 'menu'=>$menu]);
	}

	
	
}