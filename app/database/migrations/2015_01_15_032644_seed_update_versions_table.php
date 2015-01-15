<?php

use Illuminate\Database\Migrations\Migration;

class SeedUpdateVersionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::table('versions')->where('number', '!=', '4.0')->update([
			'is_documented' => 1
		]);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::table('versions')->update([
			'is_documented' => null
		]);
	}

}
