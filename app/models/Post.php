<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Post extends Eloquent {

	use SoftDeletingTrait;

<<<<<<< HEAD
	protected  $guarded = ['id','author_id'];

	protected  $dates 	= ['deleted_at', 'published_at'];
=======
	protected $table = 'posts';
	protected $guarded = ['id', 'author_id'];
	protected $dates = ['deleted_at', 'published_at'];

	/**
	 * Ralations
	 */
>>>>>>> 54f09da6ce9ac5009c314d8debc50ebbcac69208

	public function author()
	{
		return $this->belongsTo('User', "author_id");
	}

	public function comments()
	{
		return $this->morphMany("Comment", "commentable");
	}

	public function framework_version()
	{
<<<<<<< HEAD
		return $this->belongsTo("Version");
=======
		return $this->belongsTo("FrameworkVersion");
	}

	/**
	 * Scopes
	 */

	public function scopeArticle($query)
	{
		//return $query->where("")
>>>>>>> 54f09da6ce9ac5009c314d8debc50ebbcac69208
	}

	public function scopeNotDraft($query)
	{
		return $query->where("is_draft", 0);
	}

<<<<<<< HEAD
};
=======
	/**
	 * Properties
	 */

	public function isArticle()
	{
		return $this->type == "article";
	}

	/**
	 * Presenters
	 */

	public function displayText()
	{
		$parse = App::make('LaravelRU\Parser\Parse');

		return $parse->markdown($this->text);
	}

	public function displayDate()
	{
		if (is_null($this->published_at))
		{
			return 'не опубликовано';
		}

		return $this->published_at->format('d M');
	}

	public function displayPublishedAt()
	{
		if (is_null($this->published_at))
		{
			return 'не опубликовано';
		}

		return $this->published_at->format('d M');
	}

}
>>>>>>> 54f09da6ce9ac5009c314d8debc50ebbcac69208
