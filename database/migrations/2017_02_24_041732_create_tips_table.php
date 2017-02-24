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

/**
 * Class CreateTipsTable
 */
class CreateTipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tips', function (Blueprint $t) {
            $t->increments('id');
            $t->unsignedInteger('user_id')->index();
            $t->text('content_original');
            $t->text('content_rendered');
            $t->timestamps();
        });

        Schema::create('tips_rating', function (Blueprint $t) {
            $t->increments('id');
            $t->enum('type', ['Like', 'Dislike']);
            $t->unsignedInteger('tip_id');
            $t->unsignedInteger('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tips');
    }
}
