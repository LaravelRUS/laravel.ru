<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatingUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create("users", function (Blueprint $table)
		{
			$table->engine = 'InnoDB';

			$table->increments('id');
			$table->string('name')->unique();
			$table->string('email')->unique();
			$table->string('password');
			$table->string('remember_token');
			$table->boolean('is_confirmed');
			$table->timestamp('last_login_at');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('users');
	}

}
