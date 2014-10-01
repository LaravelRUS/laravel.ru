<?php
class Termtext extends \Eloquent {

	protected   $table =       'termtexts';
	protected   $primaryKey =  'id';
	public      $timestamps =  false;
	protected   $softDelete =  false;
	protected   $guarded =     [];
	protected   $hidden =      [];
	
	public function names()
    {
        return $this->belongsToMany("Term");
    }
    public function terms()
    {
        return $this->belongsToMany("Term");
    }

    public function displayText()
    {
        return $this->text;
    }

}