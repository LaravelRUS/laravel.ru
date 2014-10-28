<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class News extends Eloquent {

	protected   $table =       'news';
	protected   $primaryKey =  'id';
	public      $timestamps =  true;
	use         SoftDeletingTrait;
	protected   $dates =        ['created_at', 'updated_at', 'deleted_at'];
	protected   $guarded =     [];
	protected   $hidden =      [];

	public function author()
	{
		return $this->belongsTo("User");
	}
	
	
}