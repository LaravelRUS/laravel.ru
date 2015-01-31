<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleCategories extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('article_categories', function (Blueprint $table)
		{
			$table->engine = 'InnoDB';

			$table->increments('id');
			$table->string('title')->unique();
			$table->string('slug')->unique();
			$table->smallInteger('priority')->unsigned()->index();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('article_categories');
	}

}
