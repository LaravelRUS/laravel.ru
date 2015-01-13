<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatingDocumentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('documents', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';

			$table->increments('id');

			$table->string('title')->nullable();
			$table->string('name');
			$table->longText('text');

			$table->string('last_commit');
			$table->string('last_original_commit')->nullable();
			$table->string('current_original_commit');

			$table->timestamp("last_commit_at");
			$table->timestamp("last_original_commit_at")->nullable();
			$table->timestamp("current_original_commit_at");

			$table->integer('version_id');
			$table->integer('updater_id')->unsigned();
			$table->timestamps();

			$table->unique(array('version_id', 'name'), 'page');
			$table->foreign('updater_id')->references('id')->on('users');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('documents');
	}

}
