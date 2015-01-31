<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RefactorAgainArticlesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('article_categories', function (Blueprint $table)
		{
			$table->timestamps();
		});

		Schema::table('articles', function(Blueprint $table)
		{
			$table->dropForeign('articles_category_id_foreign');
			$table->dropColumn('category_id');
		});

		Schema::table('articles', function(Blueprint $table)
		{
			$table->unsignedInteger('category_id')->nullable()->default(null)->after('id');
			$table->foreign('category_id')->references('id')->on('article_categories')->onDelete('restrict');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('article_categories', function (Blueprint $table)
		{
			$table->dropTimestamps();
		});

		Schema::table('articles', function(Blueprint $table)
		{
			$table->dropForeign('articles_category_id_foreign');
			$table->dropColumn('category_id');
		});

		Schema::table('articles', function(Blueprint $table)
		{
			$table->unsignedInteger('category_id')->nullable();
			$table->foreign('category_id')->references('id')->on('article_categories')->onDelete('restrict');
		});


	}

}
