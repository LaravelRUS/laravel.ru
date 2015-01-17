<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatingCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('comments', function (Blueprint $table)
		{
			$table->increments('id');
			$table->text('text');
			$table->integer('author_id')->unsigned();
			$table->morphs('commentable');
			$table->timestamps();
			$table->softDeletes();
			$table->foreign('author_id')->references('id')->on('users');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('comments');
	}

}
