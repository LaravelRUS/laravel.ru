<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatingDocumentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('documents', function (Blueprint $table)
		{
			$table->engine = 'InnoDB';

			$table->increments('id');

			$table->string('title')->nullable();
			$table->string('name');
			$table->longText('text');

			$table->string('last_commit');
			$table->string('last_original_commit')->nullable();
			$table->string('current_original_commit');

			$table->timestamp('last_commit_at');
			$table->timestamp('last_original_commit_at')->nullable();
			$table->timestamp('current_original_commit_at');

			$table->integer('original_commits_ahead');

			$table->integer('version_id');

			$table->timestamps();

			$table->unique(['version_id', 'name'], 'page');
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
