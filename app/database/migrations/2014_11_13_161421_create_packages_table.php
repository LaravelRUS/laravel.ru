<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create("packages", function(Blueprint $table){
			$table->increments("id");
			$table->timestamps();
			$table->string("name");
			$table->text("description")->nullable();
			$table->string("repository");
			$table->integer("downloads");
			$table->integer("favers");

			$table->unique("name");
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists("packages");
	}

}
