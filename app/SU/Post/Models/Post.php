<?php namespace SU\Post\Models;

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Laracasts\Presenter\PresentableTrait; // https://github.com/laracasts/Presenter

class Post extends \Eloquent {

	protected   $table =        'posts';
	protected   $primaryKey =   'id';
	public      $timestamps =   true;

	protected   $fillable =     [];
    protected   $guarded =      ['id','author_id'];
    protected   $hidden =       [];

	use         SoftDeletingTrait;
	protected   $dates =        ['deleted_at', 'published_at'];

	use         PresentableTrait;
	protected   $presenter =    'SU\Post\Presenters\PostPresenter';

	public static function boot()
	{
		parent::boot();
		// Setup event bindings...
	}

	public function author()
	{
		return $this->belongsTo('SU\User\Models\User', "author_id");
	}

	// ===== Scopes =====

	public function scopeNotDraft($query)
	{
		return $query->where("is_draft", 0);
	}


};