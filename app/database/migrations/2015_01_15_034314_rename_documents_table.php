<?php

use Illuminate\Database\Migrations\Migration;

class RenameDocumentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::rename('documents', 'documentation');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::rename('documentation', 'documents');
	}

}
