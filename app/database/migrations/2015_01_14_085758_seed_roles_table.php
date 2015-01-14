<?php

use Illuminate\Database\Migrations\Migration;

class SeedRolesTable extends Migration {

	private $rolesToSeed = [
		['name' => 'administrator'],
		['name' => 'librarian'],
		['name' => 'moderator'],
		['name' => 'user']
	];

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::table('roles')->insert($this->rolesToSeed);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::table('roles')->whereIn('name', array_column($this->rolesToSeed, 'name'))->delete();
	}

}
