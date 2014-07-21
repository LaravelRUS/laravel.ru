<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		\Schema::create("users", function(Blueprint $table){
			$table->increments("id");
			$table->timestamps();
			$table->string("name");
			$table->string("email");
			$table->string("password");
			$table->string("remember_token");
			$table->timestamp("last_login_at");

			$table->unique("name");
			$table->unique("email");
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		\Schema::drop("users");
	}

}
