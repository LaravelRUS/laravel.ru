<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class IsApproveNews extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table("news", function(Blueprint $table){
			$table->tinyInteger("is_approved")->after("is_draft");
			$table->index("is_approved");
		});
		Schema::table("posts", function(Blueprint $table){
			$table->tinyInteger("is_approved")->after("is_draft");
			$table->index("is_approved");
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table("news", function(Blueprint $table){
			$table->dropColumn("is_approved");
		});
		Schema::table("posts", function(Blueprint $table){
			$table->dropColumn("is_approved");
		});
	}

}
