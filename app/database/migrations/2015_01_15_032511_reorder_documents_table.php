<?php

use Illuminate\Database\Migrations\Migration;

class ReorderDocumentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::statement('ALTER TABLE documents MODIFY COLUMN title VARCHAR(255) AFTER name');
		DB::statement('ALTER TABLE documents MODIFY COLUMN version_id INT(11) AFTER id');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::statement('ALTER TABLE documents MODIFY COLUMN title VARCHAR(255) AFTER id');
		DB::statement('ALTER TABLE documents MODIFY COLUMN version_id INT(11) AFTER original_commits_ahead');
	}

}
