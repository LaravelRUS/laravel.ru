<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Post extends \Eloquent {

	protected   $table =        'posts';
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
	
	public function framework_version()
	{
		return $this->belongsTo("FrameworkVersion");
	}

	// ===== Scopes =====

	public function scopeArticle($query)
	{
		//return $query->where("")
	}

	public function scopeNotDraft($query)
	{
		return $query->where("is_draft", 0);
	}

	// ===== Properties =====

	public function isArticle()
	{
		if($this->type == "article"){
			return true;
		}else{
			return false;
		}
	}

	// ===== Presenter =====

	public function displayText()
	{
		$parse = App::make('LaravelRU\Parser\Parse');
		return $parse->markdown($this->text);
	}

	public function displayDate()
	{
		if(is_null($this->published_at)){
			return "не опубликовано";
		}
		return $this->published_at->format("d M");
	}
	public function displayPublishedAt()
	{
		if(is_null($this->published_at)){
			return "не опубликовано";
		}
		return $this->published_at->format("d M");
	}


};