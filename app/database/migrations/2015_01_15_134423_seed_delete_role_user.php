<?php

use Illuminate\Database\Migrations\Migration;

class SeedDeleteRoleUser extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::statement("DELETE FROM roles WHERE name='user'");
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::statement("INSERT INTO roles (id, name) VALUES (4, 'user')");
	}

}
