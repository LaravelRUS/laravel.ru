<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatingUserRolePivot extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_role', function (Blueprint $table)
		{
			$table->engine = 'InnoDB';

			$table->integer('user_id')->unsigned();
			$table->integer('role_id')->unsigned();

			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('role_id')->references('id')->on('roles');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('user_role');
	}

}
