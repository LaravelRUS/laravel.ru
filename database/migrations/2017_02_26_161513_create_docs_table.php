<?php

/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateDocsTable.
 */
class CreateDocsTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('docs_categories', function (Blueprint $t) {
            $t->increments('id');
            $t->unsignedSmallInteger('priority')->default(0);
            $t->string('title');
        });

        Schema::create('docs', function (Blueprint $t) {
            $t->increments('id');
            $t->string('title');
            $t->string('version', 5);
            $t->string('slug');
            $t->longText('content_source');
            $t->longText('content_rendered');

            // Navigation
            $t->json('nav')->nullable();

            // Github
            $t->string('github_org');
            $t->string('github_repo');
            $t->string('github_branch');
            $t->string('github_file');
            $t->string('github_hash');

            // Category
            $t->unsignedInteger('category_id');
            $t->unsignedSmallInteger('priority')->default(0);

            $t->timestamps();

            $t->index(['version', 'slug']);
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('docs_categories');
        Schema::dropIfExists('docs');
    }
}
