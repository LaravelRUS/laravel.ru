<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('docs', function(Blueprint $table)
		{
			$table->increments("id");
			$table->string("framework_version", 10);
			$table->string("name", 20);
			$table->string("last_commit");
			$table->string("last_original_commit");
			$table->longText("text");
			$table->integer("updater_id");
			$table->timestamps();

			$table->index(array('framework_version', 'name'), "page");
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop("docs");
	}

}
