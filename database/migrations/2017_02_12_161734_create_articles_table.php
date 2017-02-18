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

class CreateArticlesTable extends Migration
{
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

    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
