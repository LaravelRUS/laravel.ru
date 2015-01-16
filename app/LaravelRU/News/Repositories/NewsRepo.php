<?php namespace LaravelRU\News\Repositories;

use LaravelRU\Core\Repository\BaseRepository;
use LaravelRU\News\Models\News;

class NewsRepo extends BaseRepository {

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