<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddFkDifficultyLevelsToArticlesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('articles', function (Blueprint $table)
		{
			$table->dropColumn('difficulty');
			$table->unsignedInteger('difficulty_level_id')->nullable()->default(null)->after('version_id');
		});
		Schema::table('articles', function (Blueprint $table)
		{
			$table->foreign('difficulty_level_id')->references('id')->on('difficulty_levels');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('articles', function (Blueprint $table)
		{
			$table->dropForeign('articles_difficulty_level_id_foreign');
		});

		Schema::table('articles', function (Blueprint $table)
		{
			$table->dropColumn('difficulty_level_id');
			$table->enum('difficulty', ['unknown', 'easy', 'medium', 'hard']);
		});
	}

}
