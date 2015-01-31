<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RefactorArticlesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::statement('ALTER TABLE articles MODIFY COLUMN version_id int(10) AFTER id');
		DB::statement('ALTER TABLE `articles` MODIFY `title` varchar(255) NULL DEFAULT NULL');
		DB::statement('ALTER TABLE `articles` MODIFY `slug` varchar(255) NULL DEFAULT NULL');

		Schema::table('articles', function (Blueprint $table)
		{
			$table->string('meta_description')->nullable()->default(null)->unique()->after('slug');
			$table->dropColumn('translated_url');
			$table->string('source_article_author')->nullable()->default(null)->after('meta_description');
			$table->string('source_article_url')->nullable()->default(null)->unique()->after('source_article_author');
			$table->unique(['title', 'slug']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::statement('ALTER TABLE articles MODIFY COLUMN version_id int(10) AFTER slug');
		DB::statement('ALTER TABLE `articles` MODIFY `title` varchar(255) NOT NULL');
		DB::statement('ALTER TABLE `articles` MODIFY `slug` varchar(255) NOT NULL');

		Schema::table('articles', function (Blueprint $table)
		{
			$table->dropColumn('meta_description');
			$table->string('translated_url')->after('text');
			$table->dropColumn('source_article_author');
			$table->dropColumn('source_article_url');
			$table->dropUnique(['title', 'slug']);
		});
	}

}
