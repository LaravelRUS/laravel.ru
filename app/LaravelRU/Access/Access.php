<?php namespace LaravelRU\Access;

use Auth;
use LaravelRU\Core\Access\BaseAccess;
use News;
use Post;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class Access extends BaseAccess {

	public function __construct()
	{

	}

	public function disableGuests()
	{
		if (Auth::guest())
		{
			throw new AccessDeniedException;
		}
		else
		{
			if ( ! Auth::user()->is_confirmed)
			{
				throw new AccessDeniedException;
			}
		}
	}

	public function checkEditTerms()
	{
		$this->disableGuests();
	}

	public function checkEditRoles()
	{
		if (Auth::user()->isAdmin())
		{
			return;
		}
		else
		{
			throw new AccessDeniedException;
		}
	}

	/**
	 * Новости
	 */

	public function checkCreateNews()
	{
		$this->disableGuests();
	}

	public function checkEditNews(News $news)
	{
		$this->disableGuests();

		return $news->author_id == Auth::user()->id;
	}

	public function checkApproveNews()
	{
		$this->disableGuests();

		if (Auth::user()->isAdmin() || Auth::user()->isModerator())
		{
			return;
		}
		else
		{
			throw new AccessDeniedException;
		}
	}

	/**
	 * Посты
	 */

	public function checkCreatePost()
	{
		$this->disableGuests();
	}

	public function checkEditPost(Post $post)
	{
		$this->disableGuests();

		return $post->author_id == Auth::user()->id || Auth::user()->isAdmin();
	}

}
