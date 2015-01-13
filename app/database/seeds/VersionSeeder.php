<?php

class VersionSeeder extends Seeder{

    public function run()
    {
        $verions = [
            ['iteration'=>'4.0', 'is_default' => 0, 'is_master'=> 0],
            ['iteration'=>'4.1', 'is_default' => 0, 'is_master'=> 0],
            ['iteration'=>'4.2', 'is_default' => 1, 'is_master'=> 0],
            ['iteration'=>'5.0', 'is_default' => 0, 'is_master'=> 1],
        ];
        Version::insert($verions);

    }
}