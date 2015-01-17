<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class RenameFavorsColumnAndMakeDescriptionNullableOnPackagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('packages', function (Blueprint $table)
		{
			$table->renameColumn('favors', 'favers');
		});

		DB::statement('ALTER TABLE packages '
			. 'MODIFY description TEXT NULL');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('packages', function (Blueprint $table)
		{
			$table->renameColumn('favers', 'favors');
		});

		DB::statement('ALTER TABLE packages '
			. 'MODIFY description TEXT NOT NULL');
	}

}
