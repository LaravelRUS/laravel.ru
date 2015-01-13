<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatingNewsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('news', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';

			$table->increments('id');
			$table->text('text');
			$table->boolean('is_draft');
			$table->boolean('is_approved');
			$table->integer('author_id')->unsigned();
			$table->integer('editor_id')->unsigned()->nullable();
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
		Schema::dropIfExists('news');
	}

}
