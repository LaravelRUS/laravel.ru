<?php

declare(strict_types=1);

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $this->call(UsersSeeder::class);
        $this->call(ArticlesSeeder::class);
        $this->call(TagsSeeder::class);
        $this->call(TipsSeeder::class);
    }
}
