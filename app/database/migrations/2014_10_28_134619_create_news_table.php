<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create("news", function(Blueprint $table){
			$table->increments("id");
			$table->timestamps();
			$table->softDeletes();
			$table->integer("author_id");
			$table->tinyInteger("is_draft");
			$table->enum("parser_type", ['markdown', 'uversewiki'])->default('markdown');
			$table->text("text");

			$table->index("author_id");
			$table->index("is_draft");
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists("news");
	}

}
