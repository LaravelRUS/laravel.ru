<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetDefaultToColumnsInArticlesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('articles', function (Blueprint $table)
		{
			$table->dropColumn('is_draft');
			$table->dropColumn('is_approved');
		});

		Schema::table('articles', function (Blueprint $table)
		{
			$table->boolean('is_draft')->default(1)->after('difficulty');
			$table->boolean('is_approved')->nullable()->default(null)->after('is_draft');
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
			$table->dropColumn('is_draft');
			$table->dropColumn('is_approved');
		});

		Schema::table('articles', function (Blueprint $table)
		{
			$table->boolean('is_draft')->after('difficulty');
			$table->boolean('is_approved')->after('is_draft');
		});

	}

}
