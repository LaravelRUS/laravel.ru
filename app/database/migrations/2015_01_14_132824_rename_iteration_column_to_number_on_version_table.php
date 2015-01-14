<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameIterationColumnToNumberOnVersionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('versions', function(Blueprint $table)
		{
			$table->renameColumn('iteration', 'number');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('versions', function(Blueprint $table)
		{
			$table->renameColumn('number', 'iteration');
		});
	}

}
