<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCommitTimestampsToDocs extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table("docs", function(Blueprint $table){
			$table->timestamp("last_commit_at")->after("last_commit")->nullable();
			$table->timestamp("last_original_commit_at")->after("last_original_commit")->nullable();
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
			$table->dropColumn("last_commit_at");
			$table->dropColumn("last_original_commit_at");
		});
	}

}
