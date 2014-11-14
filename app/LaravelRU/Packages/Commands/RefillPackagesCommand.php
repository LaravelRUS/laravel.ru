<?php namespace LaravelRU\Packages\Commands;

use Carbon\Carbon;
use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Console\Command;
use Indatus\Dispatcher\Drivers\Cron\Scheduler;
use Indatus\Dispatcher\Scheduling\Schedulable;
use Indatus\Dispatcher\Scheduling\ScheduledCommand;
use Package;
use Packagist\Api\Client as PackagistClient;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

use Guzzle\Http\Exception\ClientErrorResponseException;

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
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		// Собираем названия пакетов, представленных на packalyst

		$packalyst = new GuzzleClient(['base_url' => 'http://packalyst.com']);
		$maxPage = 60;
		$packageFullNames = [];
		for($n = $maxPage; $n>0; $n--){

			$packalystPage = $packalyst->get("/packages?page=$n")->getBody();
			$packalystPage = str_replace("\n", "", $packalystPage);
			preg_match_all('/<div class="package-card-inner">.*?>(.*?)<\/a>/', $packalystPage, $matchesName);
			preg_match_all('/<div class="package-card-inner">.*?Packages by (.*?)">/', $packalystPage, $matchesVendor);
			foreach($matchesName[1] as $i=>$packageName){
				$packageVendor = $matchesVendor[1][$i];
				$packageFullNames[] = "$packageVendor/$packageName";
			}
			$this->line("parse page $n");
		}
		$this->info("total packages: ".count($packageFullNames));
		$packageFullNames = array_unique($packageFullNames);
		$this->info("unique packages: ".count($packageFullNames));


		//$packageFullNames = ['slider23/laravel-modulator'];

		// Парсим инфу по пакетам с packagist
		$packagist = new PackagistClient();
		foreach($packageFullNames as $packageFullName){
			$this->line($packageFullName);
			try{
				$page = $packagist->get($packageFullName);
			}catch(ClientErrorResponseException $e){
				$this->error("$packageFullName - ".$e->getMessage());
				continue;
			}

			$package = new Package();
			$package->name = $packageFullName;
			$package->description = $page->getDescription();
			$package->created_at = Carbon::createFromTimestampUTC(strtotime($page->getTime()));
			$versions = $page->getVersions();
			if(count($versions)>0){
				$lastVersion = array_first($versions, function(){ return true; });
				$package->updated_at = Carbon::createFromTimestampUTC(strtotime($lastVersion->getTime()));
			}else{
				$package->updated_at = $package->created_at;
			}

			$package->repository = $page->getRepository();
			$package->downloads = $page->getDownloads()->getTotal();
			$package->favers = $page->getFavers();
			$package->save();
			$this->line("$packageFullName added");

		}
		$this->line("end");
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
//				array('example', InputArgument::REQUIRED, 'An example argument.'),
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
//				array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
		);
	}

	/**
	 * When a command should run
	 * @param \Indatus\Dispatcher\Scheduler $scheduler
	 * @return \Indatus\Dispatcher\Scheduling\Schedulable|\Indatus\Dispatcher\Scheduling\Schedulable[]
	 */
	public function schedule(Schedulable $scheduler)
	{
		// TODO: Implement schedule() method.
	}
}
