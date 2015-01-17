<?php namespace LaravelRU\News\Repositories;

use LaravelRU\Core\Repository\AbstractRepository;
use LaravelRU\News\Models\News;

class NewsRepo extends AbstractRepository {

	public function __construct(News $news)
	{
		$this->model = $news;
	}

	/**
	 * Последние посты
	 *
	 * @param int $num
	 * @return \Illuminate\Database\Eloquent\Collection|static[]
	 */
	public function getLastNews($num = 10)
	{
		return $this->model->approved()->notDraft()->orderBy(News::CREATED_AT, 'desc')->limit($num)->get();
	}

}