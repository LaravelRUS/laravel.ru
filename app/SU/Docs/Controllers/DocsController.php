<?php namespace SU\Docs\Controllers;

class DocsController extends \BaseController {

	public function __construct()
	{
		
	}

	public function getIndex()
	{
		return \View::make("docs/index");
	}

	
	
}