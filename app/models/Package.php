<?php

<<<<<<< HEAD

class Package extends Eloquent {
    
};
=======
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
>>>>>>> 54f09da6ce9ac5009c314d8debc50ebbcac69208
