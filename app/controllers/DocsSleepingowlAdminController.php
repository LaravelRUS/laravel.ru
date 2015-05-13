<?php

use Illuminate\Database\Eloquent\Collection;
use LaravelRU\Core\Models\Version;
use LaravelRU\Docs\Models\Documentation;
use LaravelRU\DocsSleepingowlAdmin\Models\DocumentationSleepingowlAdmin;

/**
 * Class DocsController
 */
class DocsSleepingowlAdminController extends BaseController {


	public function __construct()
	{

	}

	/**
	 * Show the docs page.
	 *
	 * @param string   $name
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
	 */
	public function docs($name = "introduction")
	{

		$page = DocumentationSleepingowlAdmin::where('name', $name)->firstOrFail();

		$menu = DocumentationSleepingowlAdmin::where('name', "menu")->first();
		//$menu->text = preg_replace('/\((.*?)\)/im', route("documentation.sleepingowl_admin")."/$1", $menu->text);

		return View::make('docs_sleepingowl_admin.docs_page', compact('menu', 'page'));
	}



}
