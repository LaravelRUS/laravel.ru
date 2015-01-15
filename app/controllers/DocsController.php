<?php

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
	protected $masterVersion;

	/**
	 * @var string
	 */
	protected $default_page = 'installation';

	/**
	 * @var array
	 */
	protected $documentedVersions;

	public function __construct()
	{
		// TODO закешировать?
		/** @var Collection versions */
		$this->versions = Version::all();

		$this->documentedVersions = $this->getAllDocumentedVersions($this->versions);

		$this->defaultVersion = $this->versions->first(function ($key, $item)
		{
			return $item->isDefault();
		});

		$this->masterVersion = $this->versions->first(function ($key, $item)
		{
			return $item->isMaster();
		});

		View::share('documentedVersions', $this->documentedVersions);
	}

	// TODO store in cookies or session
	public function docs($versionNumber = '', $page = null)
	{
		if ( ! $versionNumber)
		{
			$versionNumber = $this->defaultVersion;
		}
		elseif ($versionNumber == Version::MASTER)
		{
			$versionNumber = $this->masterVersion;
		}

		if ( ! $page) $page = $this->default_page;

		$page = Documentation::version($versionNumber)->page($page)->firstOrFail();

		$menu = Documentation::version($versionNumber)->page('documentation')->first();

		return View::make('docs.docs-page', compact('menu', 'page'));
	}

	public function updates()
	{
		$versions = Version::with([
			'documents' => function ($q)
			{
				$q->orderBy('name', 'ASC');
			}
		])->get();

		return View::make('docs/updates', compact('versions'));
	}

	/**
	 * Get all documented versions & name the master branch
	 *
	 * @param $versions
	 * @return array
	 */
	private function getAllDocumentedVersions($versions)
	{
		return $versions->filter(function ($item)
		{
			return $item->isDocumented();
		})->each(function ($item)
		{
			return $item->is_master ? $item->number = 'master' : $item;
		})->lists('number');
	}

}
