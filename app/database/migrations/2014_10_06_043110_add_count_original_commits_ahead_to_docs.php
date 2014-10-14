<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCountOriginalCommitsAheadToDocs extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table("docs", function(Blueprint $table){
			$table->integer("original_commits_ahead")->after("last_original_commit_at");
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
			$table->dropColumn("original_commits_ahead");
		});
	}

}
