<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddArticleContentPreviewField extends Migration
{
    /**
     * Run the migrations.
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
     */
    public function down()
    {
        Schema::table('articles', function (Blueprint $t) {
            $t->dropColumn(['preview_source', 'preview_rendered']);
        });
    }
}
