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
 * Class CreateDocsVersionsTable
 */
class CreateDocsVersionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('docs_versions', function (Blueprint $t) {
            $t->increments('id');
            $t->unsignedInteger('project_id');
            $t->string('version', 5);

            /**
             * Content renderer for all pages.
             * @see ~/config/renderers.php
             */
            $t->string('renderer');

            /**
             * Docs content provider (importer).
             * @see ~/src/DocsImporter/*
             */
            $t->string('importer');
            $t->json('importer_config');

            $t->timestamps();

            $t->index(['project_id', 'version']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('docs_versions');
    }
}
