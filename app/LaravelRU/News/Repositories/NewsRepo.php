<?php namespace LaravelRU\News\Repositories;

use LaravelRU\Core\Repository\BaseRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use News;

class NewsRepo extends BaseRepository {

	public function __construct(News $news){

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
		return $this->model->approved()->notDraft()->orderBy("created_at", "DESC")->limit($num)->get();
	}

}