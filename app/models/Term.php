<?php
class Term extends Eloquent {

	protected   $table =       'terms';
	protected   $primaryKey =  'id';
	public      $timestamps =  false;
	protected   $softDelete =  false;
	protected   $guarded =     [];
	protected   $hidden =      [];
    protected   $fillable =     ['name'];

    public function text()
    {
        return $this->belongsTo("Termtext");
    }

    public function displayText()
    {
        return $this->text->displayText();
    }
    public function displayName()
    {
        return e($this->name);
    }



	
}