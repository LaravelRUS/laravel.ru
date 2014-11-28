<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CategoryToTypePost extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table("posts", function(Blueprint $table){
			$table->dropColumn("category");
			$table->enum('type', ['article', 'snipet'])->default('article')->after('slug');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table("posts", function(Blueprint $table){
			$table->dropColumn("type");
			$table->enum('category', ['posts', 'news', 'snipets'])->default('posts')->after('slug');
		});
	}

}
