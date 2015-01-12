<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Tip extends Eloquent {

	use SoftDeletingTrait;

	public $timestamps = true;

	protected $table = 'tips';
	protected $guarded = [];
	protected $dates = ['deleted_at', 'published_at'];

	public function author()
	{
		return $this->belongsTo('User', 'author_id');
	}

}
