<?php namespace LaravelRU\Articles\Models;

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class DifficultyLevel extends \Eloquent {

	use SoftDeletingTrait;

	protected $dates = ['deleted_at'];

	public $timestamps = true;

	protected $fillable = [
		'title', 'slug'
	];

	public function articles()
	{
		return $this->hasMany('LaravelRU\Articles\Models\Article');
	}
}
