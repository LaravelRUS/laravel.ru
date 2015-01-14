<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddIsDocumentedToVersionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('versions', function (Blueprint $table)
		{
			$table->boolean('is_documented')->nullable()->default(null);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('versions', function (Blueprint $table)
		{
			$table->dropColumn('is_documented');
		});
	}

}
