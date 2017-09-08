<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateDocsPagesTable
 */
class CreateDocsPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('docs_pages', function (Blueprint $t) {
            $t->increments('id');

            /**
             * Related to "docs_pages_categories" table.
             */
            $t->unsignedInteger('category_id')->nullable();

            /**
             * Related to "docs".
             */
            $t->unsignedInteger('version_id'); // ID
            $t->string('identify');            // Importer file identifier
            $t->string('hash')->index();       // Importer file hash

            $t->string('title');
            $t->string('slug')->index();

            /**
             * Page body.
             */
            $t->longText('content_source');
            $t->longText('content_rendered');

            /**
             * Page navigation.
             */
            $t->json('nav')->nullable();
            $t->unsignedSmallInteger('order_id')->default(0);
            $t->timestamps();

            $t->index(['category_id', 'version_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('docs_pages');
    }
}
