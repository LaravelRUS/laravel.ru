<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCurrentOriginalCommitToDocs extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table("docs", function(Blueprint $table){
			$table->string("current_original_commit")->after("last_original_commit_at");
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
			$table->dropColumn("current_original_commit");
		});
	}

}
