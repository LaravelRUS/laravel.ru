<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;
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

function allowEditRoles()
{
	try{
		Access::checkEditRoles();
	}catch(AccessDeniedException $e){
		return false;
	}
	return true;
}

/**
 * Новости
 */

function allowCreateNews()
{
	try{
		Access::checkCreateNews();
	}catch(AccessDeniedException $e){
		return false;
	}
	return true;
}

function allowEditNews($id){

	try{
		$news = News::findOrFail($id);
	}catch(ModelNotFoundException $e){
		return false;
	}

	try{
		Access::checkEditNews($news);
	}catch(AccessDeniedException $e){
		return false;
	}

	return true;
}

function allowApproveNews(){
	try{
		Access::checkApproveNews();
	}catch(AccessDeniedException $e){
		return false;
	}
	return true;
}

/**
 * Посты
 */

function allowCreatePost(){
	try{
		Access::checkCreatePost();
	}catch(AccessDeniedException $e){
		return false;
	}
	return true;
}
