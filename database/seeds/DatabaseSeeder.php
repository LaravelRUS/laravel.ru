<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        DB::table('users')->truncate();

        User::create([
            'name'     => 'Admin',
            'email'    => 'admin@admin.com',
            'password' => 'admin',
        ]);
    }
}
