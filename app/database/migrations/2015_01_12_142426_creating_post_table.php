<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatingPostTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('posts', function (Blueprint $table)
		{
			$table->engine = 'InnoDB';

			$table->increments('id');
			$table->string('title');
			$table->text('description');
			$table->text('text');
			$table->string('translated_url');
			$table->string('slug');
			$table->enum('type', ['article', 'snippet']);
			$table->integer('version_id')->unsigned();
			$table->enum('difficulty', ['unknown', 'easy', 'medium', 'hard']);
			$table->boolean('is_draft');
			$table->boolean('is_approved');
			$table->integer('author_id')->unsigned();
			$table->integer('editor_id')->unsigned()->nullable();
			$table->timestamp('published_at')->nullable();
			$table->timestamps();
			$table->softDeletes();

			$table->foreign('author_id')->references('id')->on('users');
			$table->foreign('editor_id')->references('id')->on('users');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('posts');
	}

}
