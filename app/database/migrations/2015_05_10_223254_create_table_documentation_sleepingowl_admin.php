<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDocumentationSleepingowlAdmin extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create("documentation_sleepingowl_admin", function(Blueprint $table)
		{
			$table->engine = 'InnoDB';

			$table->increments('id');
			$table->string('title')->nullable();
			$table->string('name');
			$table->longText('text');
			$table->string('last_commit_id')->nullable();
			$table->timestamp('last_commit_at')->nullable();
			$table->timestamps();

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop("documentation_sleepingowl_admin");
	}

}
