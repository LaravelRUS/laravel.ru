<?php

use Illuminate\Database\Migrations\Migration;

class SeedVersionsTable extends Migration {

	private $versionsToSeed = [
		['iteration' => '4.0', 'is_default' => 0, 'is_master' => 0],
		['iteration' => '4.1', 'is_default' => 0, 'is_master' => 0],
		['iteration' => '4.2', 'is_default' => 1, 'is_master' => 0],
		['iteration' => '5.0', 'is_default' => 0, 'is_master' => 1]
	];

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::table('versions')->insert($this->versionsToSeed);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::table('versions')->whereIn('iteration', array_column($this->versionsToSeed, 'iteration'))->delete();
	}

}
