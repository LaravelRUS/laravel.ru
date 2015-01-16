<?php namespace LaravelRU\Packages\Commands;

use DB;
use Guzzle\Http\Exception\ClientErrorResponseException;
use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Console\Command;
use Indatus\Dispatcher\Scheduling\Schedulable;
use LaravelRU\Packages\PackageRepo;
use Packagist\Api\Client as PackagistClient;

class RefillPackagesCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'su:refill_packages';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Parse entire packalyst.';

	/**
	 * @var PackageRepo
	 */
	private $packageRepo;

	/**
	 * Create a new command instance.
	 *
	 * @param PackageRepo $packageRepo
	 */
	public function __construct(PackageRepo $packageRepo)
	{
		$this->packageRepo = $packageRepo;
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		// Ресетим базу
		DB::statement('TRUNCATE TABLE packages');
		DB::statement('ALTER TABLE packages auto_increment = 1;');

		// Собираем названия пакетов, представленных на packalyst
		$packalyst = new GuzzleClient(['base_url' => 'http://packalyst.com']);
		$maxPage = 60;
		$packageFullNames = [];

		for ($n = $maxPage; $n > 0; $n--)
		{
			$packalystPage = $packalyst->get("/packages?page=$n")->getBody();
			$packalystPage = str_replace("\n", '', $packalystPage);
			preg_match_all('/<div class="package-card-inner">.*?>(.*?)<\/a>/', $packalystPage, $matchesName);
			preg_match_all('/<div class="package-card-inner">.*?Packages by (.*?)">/', $packalystPage, $matchesVendor);

			foreach ($matchesName[1] as $i => $packageName)
			{
				$packageVendor = $matchesVendor[1][$i];
				$packageFullNames[] = "$packageVendor/$packageName";
			}

			$this->line("parse page $n");
		}

		$this->info('total packages: ' . count($packageFullNames));
		$packageFullNames = array_unique($packageFullNames);
		$this->info('unique packages: ' . count($packageFullNames));

		// Парсим инфу по пакетам с packagist
		$packagist = new PackagistClient();

		foreach ($packageFullNames as $packageFullName)
		{
			$this->line($packageFullName);
			try
			{
				$package = $this->packageRepo->createPackageFromPackagist($packageFullName);
				$package->save();
				$this->line("$packageFullName added");
			}
			catch (ClientErrorResponseException $e)
			{
				$this->error("$packageFullName - " . $e->getMessage());
				continue;
			}
		}

		$this->line('Refill finished.');
	}

	/**
	 * When a command should run
	 *
	 * @param Schedulable|Scheduler $scheduler
	 * @return \Indatus\Dispatcher\Scheduling\Schedulable|\Indatus\Dispatcher\Scheduling\Schedulable[]
	 */
	public function schedule(Schedulable $scheduler)
	{
		// TODO: Implement schedule() method.
	}

}
