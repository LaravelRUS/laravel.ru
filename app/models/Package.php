<?php

class Package extends Eloquent {

	public $timestamps = false;

	protected $table = 'packages';
	protected $guarded = [];
	protected $dates = ['created_at', 'updated_at'];

	/**
	 * Presenters
	 */

	public function displayCreatedAt()
	{
		return $this->created_at->format('d M');
	}

	public function displayUpdatedAt()
	{
		return $this->updated_at->format('d M');
	}

}
