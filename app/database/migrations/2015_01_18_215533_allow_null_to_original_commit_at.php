<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AllowNullToOriginalCommitAt extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::statement("ALTER TABLE  `documentation` CHANGE  `current_original_commit_at`  `current_original_commit_at` TIMESTAMP NULL DEFAULT NULL ;");
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::statement("ALTER TABLE  `documentation` CHANGE  `current_original_commit_at`  `current_original_commit_at` TIMESTAMP NULL DEFAULT  '0000-00-00 00:00:00';");
	}

}
