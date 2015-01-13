<?php

//use LaravelRU\Docs\DocsUtil;

// TODO change config storage to DB
// TODO если такая страница, но другой версии отсутствует - кидает 404. изменить
// TODO change to compact()
use Illuminate\Database\Eloquent\Collection;

class DocsController extends BaseController {

	/**
	 * @var Collection|static[]
	 */
	protected $versions;

	/**
	 * @var Version
	 */
	protected $default_version;

	/**
	 * @var Version
	 */
	protected $master_version;

	/**
	 * @var string
	 */
	protected $default_page = 'installation';

	public function __construct()
	{
		// TODO закешировать?
		/** @var Collection versions */
		$this->versions = Version::all();

		$this->default_version = $this->versions->first(function ($key, $item)
		{
			return $item->isDefault();
		});

		$this->master_version = $this->versions->first(function ($key, $item)
		{
			return $item->isMaster();
		});
	}

	public function defaultDocs($name = null)
	{
		if ( ! $name) $name = $this->default_page;

		return Redirect::route('docs', [$this->default_version->iteration, $name]);
	}

	public function docs($iteration = '', $name = null)
	{
		if ( ! $name) $name = $this->default_page;

		if ($iteration == Version::MASTER)
		{
			$version = $this->master_version;
		}
		else
		{
			$version = $this->versions->first(function ($key, $item) use ($iteration)
			{
				return $item->iteration == $iteration;
			});
		}

		if ($version && $version->isMaster() && $iteration == $version->iteration)
		{
			return Redirect::route('docs', [Version::MASTER, $name]);
		}

		if ( ! $version)
		{
			/**
			 * Запрошен универсальный урл типа /docs/installation
			 * средиректить на /docs/4.2/installation
			 */
			$session_version = Session::get('docs_version', $this->default_version->iteration);

			return Redirect::route('docs', [$session_version, $name]);
		}

		$page = Document::version($version)->name($name)->first();

		if ( ! $page)
		{
			return Redirect::route('docs', [$version->iteration, $this->default_page]);
		}

		$menu = Document::version($version)->name('documentation')->first();

		Session::set('docs_version', $iteration);

		return View::make('docs.docs-page', compact('page', 'menu', 'version', 'name'));
	}

	// TODO Что вообще делает этот метод?
	public function updates()
	{
		$docs = [];

		// Todo: запросы в цикле? Выпилить.
		foreach ($this->versions as $version)
		{
			$docs[$version->iteration] = Document::version($version)->orderBy('name', 'ASC')->get();
		}

		return View::make('docs/updates', compact('docs'));
	}

}
