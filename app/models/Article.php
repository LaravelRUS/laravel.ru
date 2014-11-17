<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Article extends \Eloquent {

	protected   $table =        'articles';
	protected   $primaryKey =   'id';
	public      $timestamps =   true;

	protected   $fillable =     [];
    protected   $guarded =      ['id','author_id'];
    protected   $hidden =       [];

	use         SoftDeletingTrait;
	protected   $dates =        ['deleted_at', 'published_at'];


	public static function boot()
	{
		parent::boot();
		// Setup event bindings...
	}

	public function author()
	{
		return $this->belongsTo('User', "author_id");
	}

	public function comments()
	{
		return $this->morphMany("Comment", "commentable");
	}

	// ===== Scopes =====

	public function scopeNotDraft($query)
	{
		return $query->where("is_draft", 0);
	}

	// ===== Presenter =====

	public function displayText()
	{
		$parse = App::make('LaravelRU\Parser\Parse');
		return $parse->markdown($this->text);
	}

	public function displayDate()
	{
		return $this->published_at->format("d M");
	}
	public function displayPublishedAt()
	{
		return $this->published_at->format("d M");
	}


};