<?php

class RoleSeeder extends Seeder{

    public function run()
    {
        $roles = [
            ['name'=>'administrator'],
            ['name'=>'librarian'],
            ['name'=>'moderator'],
            ['name'=>'user'],
        ];
        Role::insert($roles);
    }


}