<?php

class Termtext extends Eloquent {

	public $timestamps = false;

	protected $table = 'termtexts';
	protected $softDelete = false;
	protected $guarded = [];

	/**
	 * Ralations
	 */

	public function names()
	{
		return $this->hasMany('Term');
	}

	public function terms()
	{
		return $this->hasMany('Term');
	}

	/**
	 * Presenters
	 */

	public function displayText()
	{
		return $this->text;
	}

}
