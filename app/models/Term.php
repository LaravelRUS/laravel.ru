<?php
class Term extends Eloquent {

	protected   $table =       'terms';
	protected   $primaryKey =  'id';
	public      $timestamps =  false;
	protected   $softDelete =  false;
	protected   $guarded =     [];
	protected   $hidden =      [];

    public function text()
    {
        return $this->hasOne("Termtext");
    }

    public function displayText()
    {
        return $this->text->displayText();
    }



	
}