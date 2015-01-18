<?php

class PagesController extends BaseController {

	public function cheatSheetPage()
	{
		return View::make('pages.cheat-sheet');
	}

	public function rulesPage()
	{
		return View::make('pages.rules');
	}

	public function page($view)
	{
		if (preg_match('/[^a-z\-_]+/', $view)) App::abort(404);

		$view = 'pages.' . $view;

		if ( ! View::exists($view)) App::abort(404);

		return View::make($view);
	}

}
