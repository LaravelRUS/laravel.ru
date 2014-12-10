<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersConfirmation extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create("users_confirmation", function(Blueprint $table){
			$table->increments("id");
			$table->timestamps();
			$table->integer("user_id");
			$table->string("code");

			$table->index("user_id");
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists("users_confirmation");
	}

}
