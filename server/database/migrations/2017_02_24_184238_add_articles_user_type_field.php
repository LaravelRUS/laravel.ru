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

class AddArticlesUserTypeField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('articles', function (Blueprint $t) {
            $t->dropIndex('articles_user_id_index');
        });

        Schema::table('articles', function (Blueprint $t) {
            $t->string('user_type')
                ->default(App\Models\User::class)
                ->after('user_id');

            $t->index(['user_id', 'user_type'], 'articles_user_id_user_type_index');
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
            $t->dropIndex('articles_user_id_user_type_index');
        });

        Schema::table('articles', function (Blueprint $t) {
            $t->dropColumn('user_type');

            $t->index('user_id', 'articles_user_id_index');
        });
    }
}
