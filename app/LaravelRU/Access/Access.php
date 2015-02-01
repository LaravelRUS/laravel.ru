<?php namespace LaravelRU\Access;

use Auth;
use LaravelRU\Core\Access\BaseAccess;
use LaravelRU\News\Models\News;
use LaravelRU\Articles\Models\Article;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class Access extends BaseAccess {

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
		if (Auth::user()->isAdmin()) return;

		throw new AccessDeniedException;
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

		if (Auth::user()->isAdmin() || Auth::user()->isModerator()) return;

		throw new AccessDeniedException;
	}

	/**
	 * Статьи
	 */

	public function checkCreateArticle()
	{
		$this->disableGuests();
	}

	public function checkEditArticle(Article $article)
	{
		$this->disableGuests();

		return $article->author_id == Auth::user()->id || Auth::user()->isAdmin();
	}

}
