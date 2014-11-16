<?php 

class HookController extends BaseController {

	public function __construct()
	{
		$this->secret = "nationstation385";
	}

	public function docsIsUpdated()
	{
		Artisan::call("su:update_docs");
	}
		
	
	
}