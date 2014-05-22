<?php namespace SU\Docs\Models;

class Docs extends \Eloquent {

	protected   $table =       'docs';
	protected   $primaryKey =  'id';
	public      $timestamps =  true;
	protected   $softDelete =  false;
	protected   $guarded =     [];
	protected   $hidden =      [];


	public function scopeVersion($query, $version)
	{
		return $query->where('framework_version', '=', $version);
	}

	public function scopeName($query, $name)
	{
		return $query->where('name', '=', $name);
	}
	
}