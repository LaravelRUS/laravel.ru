<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsCommentsDisabledToArticles extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table("articles", function(Blueprint $table){
			$table->boolean('is_comments_disabled')->nullable()->default(0)->after("is_draft");
		});


	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table("articles", function(Blueprint $table){
			$table->dropColumn('is_comments_disabled');
		});
	}

}
