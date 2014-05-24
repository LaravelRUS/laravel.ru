<?php namespace SU\Docs;

class DocsUtil {

	public static function setVersion($version)
	{
		\Session::put("framework_version", $version);
	}

	public static function getVersion()
	{
		return \Session::get("framework_version", \Config::get("laravel.default_version"));
	}

	public static function renderSidebar()
	{

	}

} 