<?php

/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Service\DocsImporter\GitHub\GitHubConfig;

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
        Schema::dropIfExists('docs');
        Schema::create('docs', function (Blueprint $t) {
            $t->increments('id');
            $t->string('title');
            $t->string('slug');
            $t->string('image')->nullable();
            $t->string('version')->index();
            $t->text('description');

            /**
             * Content renderer for all pages
             * @see ~/config/renderers.php
             */
            $t->string('renderer');

            /**
             * Docs content provider (importer)
             * @see ~/src/DocsImporter/*
             */
            $t->string('importer');
            $t->json('importer_config');

            $t->timestamps();
        });


        Schema::dropIfExists('docs_pages');
        Schema::create('docs_pages', function (Blueprint $t) {
            $t->increments('id');

            /**
             * Related to "docs_pages_categories" table
             */
            $t->unsignedInteger('category_id')->index()->nullable();

            /**
             * Related to "docs"
             */
            $t->unsignedInteger('docs_id')->index(); // ID
            $t->string('identify');                  // Importer file identifier
            $t->string('hash')->index();             // Importer file hash

            $t->string('title');
            $t->string('slug')->index();

            /**
             * Page body
             */
            $t->longText('content_source');
            $t->longText('content_rendered');

            /**
             * Page navigation
             */
            $t->json('nav')->nullable();
            $t->unsignedSmallInteger('priority')->default(0);
            $t->timestamps();
        });


        Schema::dropIfExists('docs_page_categories');
        Schema::create('docs_page_categories', function (Blueprint $t) {
            $t->increments('id');
            $t->unsignedSmallInteger('priority')->default(0);
            $t->string('title');
        });

        // Insert default data
        \DB::table('docs')->insert($this->getData());
    }

    /**
     * @return array
     */
    private function getData(): array
    {
        return [
            [
                'title'           => 'Документация Laravel',
                'slug'            => 'laravel',
                'version'         => '5.4',
                'description'     => 'Русский перевод документации Laravel Framework',
                'renderer'        => 'laravel',
                'importer'        => 'github',
                'importer_config' => new GitHubConfig([
                    GitHubConfig::CONFIG_ORGANISATION => 'translation-gang',
                    GitHubConfig::CONFIG_REPOSITORY   => 'ru.docs.laravel',
                    GitHubConfig::CONFIG_BRANCH       => '5.4-ru',
                ]),
            ],
            [
                'title'           => 'Документация Laravel',
                'slug'            => 'laravel',
                'version'         => '5.3',
                'description'     => 'Русский перевод документации Laravel Framework',
                'renderer'        => 'laravel',
                'importer'        => 'github',
                'importer_config' => new GitHubConfig([
                    GitHubConfig::CONFIG_ORGANISATION => 'LaravelRUS',
                    GitHubConfig::CONFIG_REPOSITORY   => 'docs',
                    GitHubConfig::CONFIG_BRANCH       => '5.3',
                ]),
            ],
            [
                'title'           => 'Документация Laravel',
                'slug'            => 'laravel',
                'version'         => '5.2',
                'description'     => 'Русский перевод документации Laravel Framework',
                'renderer'        => 'laravel',
                'importer'        => 'github',
                'importer_config' => new GitHubConfig([
                    GitHubConfig::CONFIG_ORGANISATION => 'LaravelRUS',
                    GitHubConfig::CONFIG_REPOSITORY   => 'docs',
                    GitHubConfig::CONFIG_BRANCH       => '5.2',
                ]),
            ],
            [
                'title'           => 'Документация Laravel',
                'slug'            => 'laravel',
                'version'         => '5.1',
                'description'     => 'Русский перевод документации Laravel Framework',
                'renderer'        => 'laravel',
                'importer'        => 'github',
                'importer_config' => new GitHubConfig([
                    GitHubConfig::CONFIG_ORGANISATION => 'LaravelRUS',
                    GitHubConfig::CONFIG_REPOSITORY   => 'docs',
                    GitHubConfig::CONFIG_BRANCH       => '5.1',
                ]),
            ],
            [
                'title'           => 'Документация Laravel',
                'slug'            => 'laravel',
                'version'         => '5.0',
                'description'     => 'Русский перевод документации Laravel Framework',
                'renderer'        => 'laravel',
                'importer'        => 'github',
                'importer_config' => new GitHubConfig([
                    GitHubConfig::CONFIG_ORGANISATION => 'LaravelRUS',
                    GitHubConfig::CONFIG_REPOSITORY   => 'docs',
                    GitHubConfig::CONFIG_BRANCH       => '5.0',
                ]),
            ],
            [
                'title'           => 'Документация Laravel',
                'slug'            => 'laravel',
                'version'         => '4.2',
                'description'     => 'Русский перевод документации Laravel Framework',
                'renderer'        => 'laravel',
                'importer'        => 'github',
                'importer_config' => new GitHubConfig([
                    GitHubConfig::CONFIG_ORGANISATION => 'LaravelRUS',
                    GitHubConfig::CONFIG_REPOSITORY   => 'docs',
                    GitHubConfig::CONFIG_BRANCH       => '4.2',
                ]),
            ],
            [
                'title'           => 'Документация Laravel',
                'slug'            => 'laravel',
                'version'         => '4.1',
                'description'     => 'Русский перевод документации Laravel Framework',
                'renderer'        => 'laravel',
                'importer'        => 'github',
                'importer_config' => new GitHubConfig([
                    GitHubConfig::CONFIG_ORGANISATION => 'LaravelRUS',
                    GitHubConfig::CONFIG_REPOSITORY   => 'docs',
                    GitHubConfig::CONFIG_BRANCH       => '4.1',
                ]),
            ],
            [
                'title'           => 'Документация Lumen',
                'slug'            => 'lumen',
                'version'         => '5.1',
                'description'     => 'Русский перевод документации Lumen Framework',
                'renderer'        => 'laravel',
                'importer'        => 'github',
                'importer_config' => new GitHubConfig([
                    GitHubConfig::CONFIG_ORGANISATION => 'LaravelRUS',
                    GitHubConfig::CONFIG_REPOSITORY   => 'Lumen-docs',
                    GitHubConfig::CONFIG_BRANCH       => 'master',
                ]),
            ],
        ];
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('docs_page_categories');
        Schema::dropIfExists('docs_pages');
        Schema::dropIfExists('docs');
    }
}
