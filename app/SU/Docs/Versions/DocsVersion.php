<?php namespace SU\Docs\Versions;


class DocsVersion {

	public function set($version)
	{
		\Session::put("framework_version", $version);
	}

	public function get()
	{
		\Session::get("framework_version", \Config::get("laravel.default_version"));
	}

} 