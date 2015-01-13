<?php

use LaravelRU\Docs\DocsUtil;

// TODO change config storage to DB
// TODO если такая страница, но другой версии отсутствует - кидает 404. изменить
// TODO change to compact()
class DocsController extends BaseController {

	protected $versions;
	protected $default_version;

	public function __construct()
	{
		//Todo: закешировать?
		$this->versions = Version::lists('is_default', 'iteration');

		$this->default_version = array_search(1, $this->versions);
	}

	public function defaultDocs($name = 'installation')
	{
		return Redirect::route('docs', [$this->default_version, $name]);
	}

	public function docs($version = '', $name = 'installation')
	{
		if ( ! isset($this->versions[$version]))
		{
			// Запрошен универсальный урл типа /docs/installation - средиректить на /docs/5.0/installation
			$session_version = Session::get('docs_version');

			if ( ! $session_version)
			{
				$session_version = $this->default_version;
			}

			return Redirect::route('docs', [$session_version, $version]);
		}

		//Todo: ловим одно исключение чтобы выбросить другое?
		try
		{
			$page = Document::version($version)->name($name)->firstOrFail();
		}
		catch (Exception $e)
		{
			throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
		}

		Session::set('docs_version', $version);
		$menu = Document::version($version)->name('documentation')->first();

		return View::make('docs.docs-page', compact('page', 'menu', 'version', 'name'));
	}

	// список страниц с
	public function updates()
	{
		$docs = [];

		// Todo: запросы в цикле? Выпилить.
		foreach ($this->versions as $version => $is_default)
		{
			$docs[$version] = Document::version($version)->orderBy("name", "ASC")->get();
		}

		return View::make("docs/updates", compact("docs"));
	}

}
