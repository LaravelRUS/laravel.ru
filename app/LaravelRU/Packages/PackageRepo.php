<?php namespace LaravelRU\Packages;

use LaravelRU\Core\Repository\BaseRepository;
use Package;

class PackageRepo extends BaseRepository{

    public function __construct(Package $package)
    {
        $this->model = $package;
    }

    public function getLastCreated($num = 10)
    {
    	return $this->model->orderBy("created_at", "desc")->limit($num)->get();
    }

    public function getLastUpdated($num = 10)
    {
    	return $this->model->orderBy("updated_at", "desc")->limit($num)->get();
    }

} 