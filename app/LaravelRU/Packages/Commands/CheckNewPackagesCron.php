<?php namespace LaravelRU\Packages\Commands;

use Guzzle\Http\Exception\ClientErrorResponseException;
use Indatus\Dispatcher\Drivers\Cron\Scheduler;
use Indatus\Dispatcher\Scheduling\Schedulable;
use Indatus\Dispatcher\Scheduling\ScheduledCommand;

use GuzzleHttp\Client as GuzzleClient;

use LaravelRU\Packages\PackageRepo;
use Log;
use Package;


class CheckNewPackagesCron extends ScheduledCommand{

    protected $name =           'su:check_new_packages';
    protected $description =    'Check Packalyst RSS for new packages.';
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
        Log::info("su:check_new_packages begin");
        $packalyst = new GuzzleClient(['base_url' => 'http://packalyst.com']);
        $xml = $packalyst->get("/rss/packages")->getBody();
        $rss = simplexml_load_string($xml);
        foreach($rss->channel->item as $item){
            $this->line("Found package: $item->title");
            $package = Package::where("name", $item->title)->first();
            if( ! $package){
                // Новый пакет, добавляем
                try{
                    $package = $this->packageRepo->createPackageFromPackagist($item->title);
                    $package->save();
                    $this->info("It is a new package, add $package->name to DB");
                }catch(ClientErrorResponseException $e){
                    $this->error("$item->title - ".$e->getMessage());
                }
            }
        }
        Log::info("su:check_new_packages  end");
    }


    /**
     * When a command should run
     * @param Scheduler $scheduler
     * @return \Indatus\Dispatcher\Scheduling\Schedulable|\Indatus\Dispatcher\Scheduling\Schedulable[]
     */
    public function schedule(Schedulable $scheduler)
    {
        return $scheduler->everyMinutes(3);
    }
}