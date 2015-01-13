<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Laravelrus\LocalizedCarbon\LocalizedCarbon;

class News extends Eloquent {

	use SoftDeletingTrait;

<<<<<<< HEAD
	protected $dates = ['deleted_at'];
=======
	protected $table = 'news';
	protected $dates = ['created_at', 'updated_at', 'deleted_at'];
	protected $guarded = [];

	/**
	 * Ralations
	 */
>>>>>>> 54f09da6ce9ac5009c314d8debc50ebbcac69208

	public function author()
	{
		return $this->belongsTo('User');
	}

	public function comments()
	{
		return $this->morphMany('Comment', 'commentable');
	}

	public function scopeApproved()
	{
		return $this->where('is_approved', 1);
	}

	public function scopeNotDraft()
	{
		return $this->where('is_draft', 0);
	}

<<<<<<< HEAD
}
=======
	/**
	 * Presenters
	 */

	public function displayDate()
	{
		$date = LocalizedCarbon::instance($this->created_at);

		return $date->formatLocalized('%e %B %Y');
	}

	public function displayText()
	{
		$parse = App::make('LaravelRU\Parser\Parse');

		return $parse->markdown($this->text);
	}

}
>>>>>>> 54f09da6ce9ac5009c314d8debc50ebbcac69208
