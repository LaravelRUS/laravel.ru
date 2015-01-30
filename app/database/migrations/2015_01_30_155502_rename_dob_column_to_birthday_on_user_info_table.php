<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameDobColumnToBirthdayOnUserInfoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('user_info', function (Blueprint $table)
		{
			$table->renameColumn('dob', 'birthday');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('user_info', function (Blueprint $table)
		{
			$table->renameColumn('birthday', 'dob');
		});
	}

}
