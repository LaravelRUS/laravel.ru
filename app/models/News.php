<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Laravelrus\LocalizedCarbon\LocalizedCarbon;

class News extends Eloquent {

	use SoftDeletingTrait;

	protected $table = 'news';
	protected $dates = ['created_at', 'updated_at', 'deleted_at'];
	protected $guarded = [];

	/**
	 * Ralations
	 */

	public function author()
	{
		return $this->belongsTo('User');
	}

	public function comments()
	{
		return $this->morphMany('Comment', 'commentable');
	}

	/**
	 * Scopes
	 */

	public function scopeApproved()
	{
		return $this->where('is_approved', 1);
	}

	public function scopeNotDraft()
	{
		return $this->where('is_draft', 0);
	}

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
