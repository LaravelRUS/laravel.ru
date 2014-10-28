<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create("posts", function(Blueprint $table){
			$table->increments("id");
			$table->timestamps();
			$table->softDeletes();
			$table->timestamp("published_at")->nullable(); // дата публикации материала (снятие галки "черновик")
			$table->string("title");
			$table->string("slug");
			$table->integer("author_id");
			$table->tinyInteger("is_draft");
			$table->enum("parser_type", ['markdown', 'uversewiki'])->default('markdown');
			$table->text("text");
			$table->string("translated_url");

			$table->index("author_id");
			$table->index("slug");

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		\Schema::drop("posts");
	}

}
