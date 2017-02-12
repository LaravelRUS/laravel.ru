<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateTagsTable
 */
class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $t) {
            $t->increments('id');
            $t->string('name')->unique();
            $t->string('color', 32);
        });

        Schema::create('article_tags', function (Blueprint $t) {
            $t->increments('id');
            $t->unsignedInteger('article_id')->index();
            $t->unsignedInteger('tag_id')->index();

            $t->unique(['article_id', 'tag_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tags');
        Schema::dropIfExists('article_tags');
    }
}
