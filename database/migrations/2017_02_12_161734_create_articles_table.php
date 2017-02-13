<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $t) {
            $t->increments('id');
            $t->unsignedInteger('user_id')->index();
            $t->string('title');
            $t->string('image');
            $t->string('slug')->unique()->index();
            $t->longText('content_source');
            $t->longText('content_rendered');
            $t->enum('status', [
                'Draft',        // Черновик
                'Review',       // Ожидает подтверждения
                'Published',    // Опубликован
            ])->default('Draft');
            $t->timestamp('published_at');
            $t->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
