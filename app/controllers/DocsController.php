<?php

use LaravelRU\Docs\DocsUtil;

// TODO change config storage to DB
// TODO если такая страница, но другой версии отсутствует - кидает 404. изменить
// TODO change to compact()
class DocsController extends BaseController {

<<<<<<< HEAD
	protected $default_version;

	protected $versions;



	public function __construct()
	{
		//Todo: закешировать?
		$this->versions = Version::lists('is_default', 'iteration');

		$this->default_version = array_search( 1, $this->versions);
	}

	public function defaultDocs($name = "installation")
	{
        return Redirect::route("docs", [$this->default_version, $name]);
=======
	public function defaultDocs($name = "installation")
	{
		$default_version = Config::get("laravel.default_version");

		return Redirect::route("docs", [$default_version, $name]);
>>>>>>> 54f09da6ce9ac5009c314d8debc50ebbcac69208
	}

	public function docs($version = "", $name = "installation")
	{
<<<<<<< HEAD
		if( ! in_array($version, $this->versions)){

			// Запрошен универсальный урл типа /docs/installation - средиректить на /docs/5.0/installation
			$session_version = Session::get("docs_version");
			if( ! $session_version){
				$session_version = $this->default_version;
=======
		if ( ! in_array($version, Config::get("laravel.versions")))
		{
			// Запрошен универсальный урл типа /docs/installation - средиректить на /docs/5.0/installation
			$session_version = Session::get("docs_version");
			if ( ! $session_version)
			{
				$session_version = Config::get("laravel.default_version");
>>>>>>> 54f09da6ce9ac5009c314d8debc50ebbcac69208
			}

			return Redirect::route("docs", [$session_version, $version]);
		}

<<<<<<< HEAD
		//Todo: ловим одно исключение чтобы выбросить другое?
		try{
			$page = Document::version($version)->name($name)->firstOrFail();
		}catch(Exception $e){
=======
		try
		{
			$page = Docs::version($version)->name($name)->firstOrFail();
		}
		catch (Exception $e)
		{
>>>>>>> 54f09da6ce9ac5009c314d8debc50ebbcac69208
			throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
		}

		Session::set("docs_version", $version);
		$menu = Document::version($version)->name("documentation")->first();

		return View::make("docs.docs-page", ['page' => $page, 'menu' => $menu, 'version' => $version, 'name' => $name]);
	}

	// список страниц с
	public function updates()
	{
		$docs = [];
<<<<<<< HEAD
		// Todo: запросы в цикле? Выпилить.
		foreach($this->versions as $version => $is_default){
			$docs[$version] = Document::version($version)->orderBy("name", "ASC")->get();
=======
		foreach (\Config::get("laravel.versions") as $version)
		{
			$docs[$version] = Docs::version($version)->orderBy("name", "ASC")->get();
>>>>>>> 54f09da6ce9ac5009c314d8debc50ebbcac69208
		}

		return View::make("docs/updates", compact("docs"));
	}

}