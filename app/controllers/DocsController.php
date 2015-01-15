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

	public function docs($number = '', $name = null)
	{
		if ( ! $name) $name = $this->default_page;

		if ($number == Version::MASTER)
		{
			$version = $this->master_version;
		}
		else
		{
			$version = $this->versions->first(function ($key, $item) use ($number)
			{
				return $item->number == $number;
			});
		}

		if ($version && $version->isMaster() && $number == $version->number)
		{
			return Redirect::route('docs', [Version::MASTER, $name]);
		}

		if ( ! $version)
		{
			/**
			 * Запрошен универсальный урл типа /docs/installation
			 * средиректить на /docs/4.2/installation
			 */
			$session_version = Session::get('docs_version', $this->default_version->number);

			return Redirect::route('docs', [$session_version, $name]);
		}

		$page = Documentation::version($version)->page($name)->first();

		if ( ! $page)
		{
			return Redirect::route('docs', [$version->number, $this->default_page]);
		}

		$menu = Documentation::version($version)->page('documentation')->first();

		Session::set('docs_version', $number);

		return View::make('docs.docs-page', compact('page', 'menu', 'version', 'name'));
	}

	public function updates()
	{
		$versions = Version::with(['documents' => function ($q)
		{
			$q->orderBy('name', 'ASC');
		}])->get();

		return View::make('docs/updates', compact('versions'));
	}

}
