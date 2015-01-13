<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Tip extends Eloquent {

	use SoftDeletingTrait;

	protected   $dates = ['deleted_at', 'published_at'];

	public function author()
	{
		return $this->belongsTo('User', 'author_id');
	}

	public function version()
	{
		return $this->belongsTo('Version');
	}
	
}
