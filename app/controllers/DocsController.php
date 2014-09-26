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

	public function docs($version, $name = "installation")
	{
		$page = Docs::version($version)->name($name)->first();

		$parsedown = new Parsedown();
		$html = $parsedown->text($page->text);

		$menu = Docs::version($version)->name("menu")->first();
		$sidebar =  $parsedown->text($menu->text);

		return View::make("docs/docpage", ['html'=>$html, 'title'=>$page->title, 'sidebar'=>$sidebar]);
	}

	
	
}