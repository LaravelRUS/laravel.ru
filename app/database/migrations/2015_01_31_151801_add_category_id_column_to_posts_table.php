<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCategoryIdColumnToPostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('articles', function (Blueprint $table)
		{
			$table->unsignedInteger('category_id')->nullable();

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
		Schema::table('articles', function(Blueprint $table)
		{
			$table->dropForeign('articles_category_id_foreign');
			$table->dropColumn('category_id');
		});
	}

}
