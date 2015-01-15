<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameTheDocumentationNameColumn extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('documentation', function (Blueprint $table)
		{
			$table->renameColumn('name', 'page');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('documentation', function (Blueprint $table)
		{
			$table->renameColumn('page', 'name');
		});
	}

}
