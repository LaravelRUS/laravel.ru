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

function allowEditNews(News $news)
{
	try{
		Access::checkEditNews($news);
	}catch(AccessDeniedException $e){
		return false;
	}
	return true;
}

function allowCreateHomework()
{
	try{
		Access::checkCreateHomework();
	}catch(AccessDeniedException $e){
		return false;
	}
	return true;
}

function allowEditHomework(Homework $homework)
{
	try{
		Access::checkEditHomework($homework);
	}catch(AccessDeniedException $e){
		return false;
	}
	return true;
}

function allowAddGallery()
{
	try{
		Access::checkAddGallery();
	}catch(AccessDeniedException $e){
		return false;
	}
	return true;
}

function allowEditGallery(Gallery $gallery)
{
	try{
		Access::checkEditGallery($gallery);
	}catch(AccessDeniedException $e){
		return false;
	}
	return true;
}

function allowEditPhoto(GalleryPhoto $photo)
{
	try{
		Access::checkEditPhoto($photo);
	}catch(AccessDeniedException $e){
		return false;
	}
	return true;
}

function allowCreateOrgreport()
{
	try{
		Access::checkCreateOrgreport();
	}catch(AccessDeniedException $e){
		return false;
	}
	return true;
}

function allowEditOrgreport($orgreport)
{
	try{
		Access::checkEditOrgreport($orgreport);
	}catch(AccessDeniedException $e){
		return false;
	}
	return true;
}

