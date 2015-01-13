<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Tip extends Model {

	use SoftDeletingTrait;

	protected $dates = ['deleted_at', 'published_at'];

	public function author()
	{
		return $this->belongsTo('User', 'author_id');
	}

	public function version()
	{
		return $this->belongsTo('Version');
	}

}
