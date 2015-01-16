<?php

use LaravelRU\Post\Models\Post;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use LaravelRU\Access\Facades\Access;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

function isNeedConfirmation()
{
	return Auth::check() && ! Auth::user()->isActive();
}

function isAdmin()
{
	if (Auth::guest()) return false;

	return Auth::user()->isAdmin();
}

function isModerator()
{
	if (Auth::guest()) return false;

	return Auth::user()->isModerator();
}

function isLibrarian()
{
	if (Auth::guest()) return false;

	return Auth::user()->isLibrarian();
}

// ------------------------------

function allowEditTerms()
{
	try
	{
		Access::checkEditTerms();
	}
	catch (AccessDeniedException $e)
	{
		return false;
	}

	return true;
}

function allowEditRoles()
{
	try
	{
		Access::checkEditRoles();
	}
	catch (AccessDeniedException $e)
	{
		return false;
	}

	return true;
}

/**
 * Новости
 */

function allowCreateNews()
{
	try
	{
		Access::checkCreateNews();
	}
	catch (AccessDeniedException $e)
	{
		return false;
	}

	return true;
}

function allowEditNews($id)
{
	try
	{
		$news = LaravelRU\News\Models\News::findOrFail($id);
	}
	catch (ModelNotFoundException $e)
	{
		return false;
	}

	try
	{
		Access::checkEditNews($news);
	}
	catch (AccessDeniedException $e)
	{
		return false;
	}

	return true;
}

function allowApproveNews()
{
	try
	{
		Access::checkApproveNews();
	}
	catch (AccessDeniedException $e)
	{
		return false;
	}

	return true;
}

/**
 * Посты
 */

function allowCreatePost()
{
	try
	{
		Access::checkCreatePost();
	}
	catch (AccessDeniedException $e)
	{
		return false;
	}

	return true;
}

function allowEditPost($id)
{
	if ($id instanceof Post)
	{
		$post = $id;
	}
	else
	{
		$post = Post::find($id);
	}

	if ( ! $post) return false;

	try
	{
		Access::checkEditPost($post);
	}
	catch (AccessDeniedException $e)
	{
		return false;
	}

	return true;
}
