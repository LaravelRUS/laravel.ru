<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RefactorUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function (Blueprint $table)
		{
			$table->dropColumn('fullname');
		});

		Schema::dropIfExists('user_info');

		Schema::create('user_info', function (Blueprint $table)
		{
			$table->increments('id');
			$table->unsignedInteger('user_id');
			$table->string('name')->nullable()->default(null);
			$table->string('surname')->nullable()->default(null);
			$table->date('birthday')->nullable()->default(null);
			$table->string('about')->nullable()->default(null);
			$table->string('website')->nullable()->default(null);
			$table->string('skype')->nullable()->default(null);

			$table->foreign('user_id')->references('id')->on('users');
		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users', function(Blueprint $table)
		{
			$table->string('fullname');
		});

		Schema::dropIfExists('user_info');

		Schema::create('user_info', function (Blueprint $table)
		{
			$table->engine = 'InnoDB';

			$table->increments('id');
			$table->date('dob');
			$table->string('about');
			$table->string('site');
			$table->string('skype');
			$table->integer('user_id')->unsigned();

			$table->foreign('user_id')->references('id')->on('users');
		});
	}

}