<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatingVersionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('versions', function (Blueprint $table)
		{
			$table->engine = 'InnoDB';

			$table->increments('id');
			$table->string('iteration');
			$table->boolean('is_master');
			$table->boolean('is_default');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('versions');
	}

}
