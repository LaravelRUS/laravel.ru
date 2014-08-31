<?php

use Docs;
use LaravelRU\Docs\DocsUtil;

class DocsController extends BaseController {

	public function __construct()
	{
		
	}

	public function getIndex()
	{
		return View::make("docs/index");
	}

	public function getPage($name = "installation")
	{
		$version = DocsUtil::getVersion();
		$page = Docs::version($version)->name($name)->first();

		$parsedown = new \Parsedown();
		$html = $parsedown->text($page->text);

		$menu = Docs::version($version)->name("menu")->first();
		$sidebar =  $parsedown->text($menu->text);

		return View::make("docs/docpage", ['html'=>$html, 'title'=>$page->title, 'sidebar'=>$sidebar]);
	}

	
	
}