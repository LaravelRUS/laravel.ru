<?php 

class HookController extends BaseController {

	public function __construct()
	{
		$this->secret = "nationstation385";
	}

	public function docsIsUpdated()
	{
		$input = Input::json();
		if($input->secret != $this->secret) return;

		Artisan::call("su:update_docs");
	}
		
	
	
}