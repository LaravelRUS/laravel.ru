<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use LaravelRU\Articles\Models\DifficultyLevel;

class CreateDifficultyLevelsTable extends Migration {

	private $levels = [
		[
			'title' => 'Лёгкий',
			'slug' => 'easy'
		],
		[
			'title' => 'Средний',
			'slug' => 'medium'
		],
		[
			'title' => 'Сложный',
			'slug' => 'hard'
		]
	];

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('difficulty_levels', function (Blueprint $table)
		{
			$table->increments('id');
			$table->string('title')->unique();
			$table->string('slug')->unique();
			$table->unsignedInteger('priority')->default(1);
			$table->timestamps();
			$table->softDeletes();
		});

		foreach ($this->levels as $level)
		{
			DifficultyLevel::create($level);
		}
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('difficulty_levels');
	}

}
