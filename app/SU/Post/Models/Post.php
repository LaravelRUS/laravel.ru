<?php namespace SU\Post\Models;

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Laracasts\Presenter\PresentableTrait; // https://github.com/laracasts/Presenter

class Post extends \Eloquent {

	protected   $table =        'posts';
	protected   $primaryKey =   'id';
	public      $timestamps =   true;

	protected   $fillable =     [];
    protected   $guarded =      [];
    protected   $hidden =       [];

	use         SoftDeletingTrait;
	protected   $dates =        ['deleted_at'];

	use         PresentableTrait;
	protected   $presenter =    'SU\Post\Presenters\PostPresenter';

	public static function boot()
	{
		parent::boot();
		// Setup event bindings...
	}

};