<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Tip extends Eloquent {

	protected   $table =       'tips';
	protected   $primaryKey =  'id';
	public      $timestamps =  true;
	protected   $guarded =     [];
	protected   $hidden =      [];

	use         SoftDeletingTrait;
	protected   $dates =        ['deleted_at', 'published_at'];

	public function author()
	{
		return $this->belongsTo("User", "author_id");
	}
	
}