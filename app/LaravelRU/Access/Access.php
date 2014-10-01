<?php namespace LaravelRU\Access;

use Auth;
use LaravelRU\Core\Access\BaseAccess;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class Access extends BaseAccess{

	public function __construct()
	{

	}

	public function disableGuests()
	{
		if(Auth::guest()){
			throw new AccessDeniedException;
		}
	}

	public function checkEditTerms()
	{
		$this->disableGuests();
	}




} 