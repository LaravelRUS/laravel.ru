<?php

use LaravelRU\Access\Facades\Access;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

function allowEditTerms()
{
	try{
		Access::checkEditTerms();
	}catch(AccessDeniedException $e){
		return false;
	}
	return true;
}

