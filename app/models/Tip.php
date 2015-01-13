<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Tip extends Eloquent {

	use SoftDeletingTrait;

<<<<<<< HEAD


	protected   $dates = ['deleted_at', 'published_at'];
=======
	public $timestamps = true;

	protected $table = 'tips';
	protected $guarded = [];
	protected $dates = ['deleted_at', 'published_at'];
>>>>>>> 54f09da6ce9ac5009c314d8debc50ebbcac69208

	public function author()
	{
		return $this->belongsTo('User', 'author_id');
	}

<<<<<<< HEAD
	public function version()
	{
		return $this->belongsTo('Version');
	}
	
}
=======
}
>>>>>>> 54f09da6ce9ac5009c314d8debc50ebbcac69208
