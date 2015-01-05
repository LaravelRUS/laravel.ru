<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFrameworkVersionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create("framework_versions", function(Blueprint $table){
			$table->increments('id');
			$table->string('version');
			$table->text('description')->nullable();
		});

		DB::statement("INSERT INTO framework_versions (`version`) VALUES ('4.x')");
		DB::statement("INSERT INTO framework_versions (`version`) VALUES ('4.0')");
		DB::statement("INSERT INTO framework_versions (`version`) VALUES ('4.1')");
		DB::statement("INSERT INTO framework_versions (`version`) VALUES ('4.2')");
		DB::statement("INSERT INTO framework_versions (`version`) VALUES ('5.x')");
		DB::statement("INSERT INTO framework_versions (`version`) VALUES ('5.0')");

		Schema::table("posts", function(Blueprint $table){
			$table->integer("frameworkversion_id")->after("author_id");
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists("framework_versions");
		Schema::table("posts", function(Blueprint $table){
			$table->dropColumn("frameworkversion_id");
		});
	}

}
