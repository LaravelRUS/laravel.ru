<?php

use Illuminate\Database\Eloquent\Collection;

/**
 * Class DocsController
 */
class DocsController extends BaseController {

	/**
	 * All framework versions.
	 *
	 * @var Collection|static[]
	 */
	protected $versions;

	/**
	 * The documented framework versions.
	 *
	 * @var array
	 */
	protected $documentedVersions;

	/**
	 * The default framework version.
	 *
	 * @var Version
	 */
	protected $defaultVersion;

	/**
	 * The master framework version.
	 *
	 * @var Version
	 */
	protected $masterVersion;

	/**
	 * The default docs page.
	 *
	 * @var string
	 */
	protected $defaultPage = 'introduction';

	/**
	 * Constructor function.
	 */
	public function __construct()
	{
		// TODO закешировать?
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

	/**
	 * Show the docs page.
	 *
	 * @param string $versionNumber
	 * @param null   $page
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
	 */
	public function docs($versionNumber = '', $page = null)
	{
		if ( ! $versionNumber && ! $page)
		{
			$versionNumber = $this->checkForVersionInCookies();

			return Redirect::route('documentation', [$versionNumber, $this->defaultPage]);
		}

		if ($versionNumber && ! $page)
		{
			if ( ! in_array($versionNumber, $this->documentedVersions))
			{
				$page = $versionNumber;

				$versionNumber = $this->checkForVersionInCookies();

				return Redirect::route('documentation', [$versionNumber, $page]);
			}

			return Redirect::route('documentation', [$versionNumber, $this->defaultPage]);
		}

		if ($versionNumber == $this->masterVersion->getOriginal('number'))
		{
			return Response::view('errors.404', [], 404);
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

	/**
	 * Show the translation status page.
	 *
	 * @return \Illuminate\View\View
	 */
	public function status()
	{
		$versions = Version::documented()->withDocumentation()->get();

		return View::make('docs.status', compact('versions'));
	}

	/**
	 * Get all documented versions & rename the master branch.
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

	/**
	 * Check the cookies for docs version or return the default one.
	 *
	 * @return mixed|null|string|Version
	 */
	private function checkForVersionInCookies()
	{
		return Cookie::has('docs_version') ? Cookie::get('docs_version') : $this->defaultVersion;
	}

}
