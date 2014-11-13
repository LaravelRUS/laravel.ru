<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableComments extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create("comments", function(Blueprint $table){
			$table->increments("id");
			$table->timestamps();
			$table->integer("author_id");
			$table->integer("answer_to");
			$table->integer("root_answer_to");
			$table->morphs("commentable");
			$table->text("text");

			$table->index("root_answer_to");
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists("comments");
	}

}
