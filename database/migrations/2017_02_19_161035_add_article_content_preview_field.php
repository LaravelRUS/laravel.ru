<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddArticleContentPreviewField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('articles', function (Blueprint $t) {
            $t->text('preview_rendered')->after('slug');
            $t->text('preview_source')->after('slug');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('articles', function (Blueprint $t) {
            $t->dropColumn(['preview_source', 'preview_rendered']);
        });
    }
}
