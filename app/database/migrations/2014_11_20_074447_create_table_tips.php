<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTips extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create("tips", function(Blueprint $table){
			$table->increments("id");
			$table->timestamps();
			$table->timestamp("published_at");
			$table->integer("author_id");
			$table->text("text");
			$table->string("link");
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists("tips");
	}

}
