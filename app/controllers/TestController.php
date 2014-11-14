<?php

use LaravelRU\Github\GithubRepo;

class TestController extends BaseController {

	public function __construct()
	{

	}

	public function getIndex()
	{
		$client = new Packagist\Api\Client();
		$name = "volicon/laravel-acl";
		$package = $client->get($name);
		//var_dump($package);
		$versions = $package->getVersions();
		var_dump(array_first($versions, function(){ return true; }));
	}

	public function getFail()
	{
		$package = Package::where("name", "dfdfsgsd")->first();
		dd($package);
	}

	public function getUtf($string)
	{
		return $string;
	}

	public function getPregmatch()
	{
		var_dump(preg_match("#^/test/(?P<utf>[а-я]+)$#su", "/test/слово"));
	}

	public function getCommit()
	{
		$client = new \Github\Client();
		$commits = $client->api('repo')->commits()->all('laravel', 'docs', array('sha' => 'master', 'path' => 'eloquent.md'));
		dd($commits);

	}
		
	
	
}