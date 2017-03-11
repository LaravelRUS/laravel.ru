<?php

/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTable extends Migration
{
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

    public function down()
    {
        Schema::dropIfExists('tags');
        Schema::dropIfExists('article_tags');
    }
}
