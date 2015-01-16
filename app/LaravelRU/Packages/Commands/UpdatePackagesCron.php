<?php namespace LaravelRU\Packages\Commands;

use Guzzle\Http\Exception\ClientErrorResponseException;
use Indatus\Dispatcher\Scheduling\Schedulable;
use Indatus\Dispatcher\Scheduling\ScheduledCommand;
use LaravelRU\Packages\PackageRepo;
use Log;
use LaravelRU\Packages\Models\Package;

class UpdatePackagesCron extends ScheduledCommand {

	protected $name = 'su:update_packages';

	protected $description = 'Check all packages for updated_at';

	/**
	 * @var
	 */
	private $packageRepo;

	public function __construct(PackageRepo $packageRepo)
	{
		$this->packageRepo = $packageRepo;
		parent::__construct();
	}

	public function fire()
	{
		Log::info('su:update_packages begin');
		$packages = Package::all();

		foreach ($packages as $package)
		{
			$this->line($package->name);

			try
			{
				$package = $this->packageRepo->updatePackageFromPackagist($package);

				if ($package->isDirty())
				{
					$this->info("$package->name is updated");
				}

				$package->save();

			}
			catch (ClientErrorResponseException $e)
			{
				$this->error($package->name . ' - ' . $e->getMessage());
			}
		}
		Log::info('su:update_packages   end');
	}

	/**
	 * When a command should run
	 *
	 * @param Schedulable|\Indatus\Dispatcher\Scheduler $scheduler
	 * @return \Indatus\Dispatcher\Scheduling\Schedulable|\Indatus\Dispatcher\Scheduling\Schedulable[]
	 */
	public function schedule(Schedulable $scheduler)
	{
		return $scheduler->everyMinutes(20);
	}
}
