<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTermsAndSynonyms extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create("terms", function(Blueprint $table){
            $table->increments("id");
            $table->string("name");
            $table->integer("termtext_id");

            $table->index("name");
        });

        Schema::create("term_texts", function(Blueprint $table){
            $table->increments("id");
            $table->text("text");
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::dropIfExists("terms");
        Schema::dropIfExists("term_texts");
	}

}
