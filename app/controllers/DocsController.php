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
	protected $defaultVersion;

	/**
	 * @var Version
	 */
	protected $masterVersion;

	/**
	 * @var string
	 */
	protected $defaultPage = 'introduction';

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

	public function docs($versionNumber = '', $page = null)
	{
		if ( ! $versionNumber && ! $page)
		{
			$versionNumber = $this->checkForVersionInCookies();

			return Redirect::route('docs', [$versionNumber, $this->defaultPage]);
		}

		if ($versionNumber && ! $page)
		{
			if ( ! in_array($versionNumber, $this->documentedVersions))
			{
				$page = $versionNumber;

				$versionNumber = $this->checkForVersionInCookies();

				return Redirect::route('docs', [$versionNumber, $page]);
			}

			return Redirect::route('docs', [$versionNumber, $this->defaultPage]);
		}

		if ($versionNumber == Version::MASTER)
		{
			$versionNumber = $this->masterVersion;
		}

		Cookie::queue('docs_version', $versionNumber, 2628000);

		$page = Documentation::version($versionNumber)->page($page)->firstOrFail();

		$menu = Documentation::version($versionNumber)->page('documentation')->first();

		return View::make('docs.docs-page', compact('menu', 'page'));
	}

	public function updates()
	{
		$versions = Version::with([
			'documentation' => function ($q)
			{
				$q->orderBy('page', 'ASC');
			}
		])->get();

		return View::make('docs.updates', compact('versions'));
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

	private function checkForVersionInCookies()
	{
		return Cookie::has('docs_version') ? Cookie::get('docs_version') : $this->defaultVersion;
	}

}
