<?php

class PagesController extends BaseController {

	public function cheatSheetPage()
	{
		return view('pages.cheat-sheet');
	}

	public function rulesPage()
	{
		return view('pages.rules');
	}

	public function page($view)
	{
		$view = 'pages.' . $view;

		if ( ! view()->exists($view)) abort();

		return view($view);
	}

}
