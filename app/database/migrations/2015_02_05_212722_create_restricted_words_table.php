<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use LaravelRU\Core\Models\RestrictedWord;

class CreateRestrictedWordsTable extends Migration {

	private $restrictedWords = [
		'work', 'works', 'job', 'jobs', 'user', 'users', 'admin', 'administrator', 'manager', 'moderator', 'laravel', 'community', 'people', 'article', 'page', 'pages', 'articles', 'cat', 'cats', 'category', 'categories', 'test', 'tests', 'route', 'router', 'spam', 'spammer', 'drugs', 'drugger', 'votes', 'comments', 'comment', 'settings', 'value', 'values', 'help', 'helper', 'sos', 'mama', 'papa'
	];

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('restricted_words', function (Blueprint $table)
		{
			$table->increments('id');
			$table->string('title')->unique();
			$table->timestamps();
			$table->softDeletes();
		});

		foreach ($this->restrictedWords as $word)
		{
			RestrictedWord::create([
				'title' => $word
			]);
		}
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('restricted_words');
	}

}
