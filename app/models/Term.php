<?php

class Term extends Eloquent {

	public $timestamps = false;

	protected $table = 'terms';
	protected $primaryKey = 'id';
	protected $softDelete = false;
	protected $guarded = [];
	protected $fillable = ['name'];

	/**
	 * Ralations
	 */

	public function text()
	{
		return $this->belongsTo('Termtext');
	}

	/**
	 * Presenters
	 */

	public function displayText()
	{
		return $this->text->displayText();
	}

	public function displayName()
	{
		return e($this->name);
	}

}
