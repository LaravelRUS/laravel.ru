<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColumnTypeUserRoles extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table("user_roles", function(Blueprint $table){
			$table->dropColumn("name");
		});
		Schema::table("user_roles", function(Blueprint $table){
			$table->string("name");
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// no way back
	}

}
