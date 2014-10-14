<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserRoles extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create("user_roles", function(Blueprint $table){
			$table->increments("id");
			$table->enum("name", ['administrator', 'librarian', 'moderator']);
		});

		Schema::create("user_role_pivot", function(Blueprint $table){
			$table->integer("user_id");
			$table->integer("role_id");
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists("user_roles");
		Schema::dropIfExists("user_role_pivot");
	}

}
