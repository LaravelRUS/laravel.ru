<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedUserRolesToDb extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::statement("ALTER TABLE `user_roles` CHANGE  `id`  `id` INT( 10 ) UNSIGNED NOT NULL");
		DB::statement("INSERT INTO user_roles SET id='1', name='administrator'");
		DB::statement("INSERT INTO user_roles SET id='2', name='moderator'");
		DB::statement("INSERT INTO user_roles SET id='3', name='librarian'");
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::statement("TRUNCATE TABLE user_roles");
	}

}
