<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDateOfCurrentOriginalCommit extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table("docs", function(Blueprint $table){
			$table->timestamp("current_original_commit_at")->after("current_original_commit");
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table("docs", function(Blueprint $table){
			$table->dropColumn("current_original_commit_at");
		});
	}

}
