<?php 

class TestController extends \BaseController {

	public function getIndex()
	{
		return "test_index";
	}

	public function getCommitByFile()
	{
		$client = new \Github\Client();
		$commits = $client->api('repo')->commits()->all('laravel', 'docs', array('sha' => '4.1', 'path' => 'html.md'));
		dd($commits);
	}
		
	
	
}