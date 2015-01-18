<?php

class PagesController extends BaseController {

	public function cheatSheetPage()
	{
		return View::make('cheat-sheet/cheat-sheet');
	}

	public function rules()
	{
		return View::make('pages/rules');
	}

}
