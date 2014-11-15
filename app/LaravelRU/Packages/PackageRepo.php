<?php namespace LaravelRU\Packages;

use Carbon\Carbon;
use Guzzle\Http\Exception\ClientErrorResponseException;
use LaravelRU\Core\Repository\BaseRepository;
use Packagist\Api\Client as PackagistClient;
use Package;

class PackageRepo extends BaseRepository{

    private $packagist;

    public function __construct(Package $package, PackagistClient $packagist)
    {
        $this->model = $package;
        $this->packagist = $packagist;
    }

    public function getLastCreated($num = 10)
    {
    	return $this->model->orderBy("created_at", "desc")->limit($num)->get();
    }

    public function getLastUpdated($num = 10)
    {
    	return $this->model->orderBy("updated_at", "desc")->limit($num)->get();
    }

    /**
     * @param string $name
     * @throw Guzzle\Http\Exception\ClientErrorResponseException
     * @return Package
     */
    public function createPackageFromPackagist($name)
    {
        $page = $this->packagist->get($name);
        $package = new Package();
        $package->name = $name;
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

        return $package;
    }

    public function updatePackageFromPackagist(Package $package)
    {
        $page = $this->packagist->get($package->name);
        $versions = $page->getVersions();
        if(count($versions)>0){
            $lastVersion = array_first($versions, function(){ return true; });
            $package->updated_at = Carbon::createFromTimestampUTC(strtotime($lastVersion->getTime()));
        }
        return $package;
    }

} 