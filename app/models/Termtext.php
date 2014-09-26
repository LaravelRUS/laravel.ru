<?php
class Termtext extends \Eloquent {

	protected   $table =       'term_texts';
	protected   $primaryKey =  'id';
	public      $timestamps =  false;
	protected   $softDelete =  false;
	protected   $guarded =     [];
	protected   $hidden =      [];
	
	public function names()
    {
        return $this->belongsToMany("Term");
    }

    public function displayText()
    {
        return $this->text;
    }

}