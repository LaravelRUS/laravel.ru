<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCategoriesToPost extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table("posts", function(Blueprint $table){
			$table->text("description")->after('title');
			$table->enum('category', ['posts', 'news', 'snipets'])->default('posts')->after('slug');
			$table->enum('difficulty', ['unknown', 'easy', 'medium', 'hard'])->default('unknown')->after('author_id');

			$table->index("category");
			$table->index("difficulty");
		});

		DB::statement("ALTER TABLE `posts` CHANGE  `text` `text` LONGTEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL ;");

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table("posts", function(Blueprint $table){
			$table->dropColumn("description");
			$table->dropColumn("category");
			$table->dropColumn("difficulty");
		});
	}

}
