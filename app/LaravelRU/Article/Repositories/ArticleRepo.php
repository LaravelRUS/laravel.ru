<?php namespace LaravelRU\Article\Repositories;

use LaravelRU\Core\Repository\BaseRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Article;

class ArticleRepo extends BaseRepository {
	
	public function __construct(Article $article)
	{
		$this->model = $article;
	}

	/**
	 * id автора поста
	 *
	 * @param int $article_id
	 * @return int
	 */
	public function getAuthorId($article_id)
	{
		$author_id = $this->model->where("id", $article_id)->first(["author_id"])->author_id;
		return $author_id;
	}
	public function getAuthorIdBySlug($slug)
	{
		$author_id = $this->model->where("slug", $slug)->first(["author_id"])->author_id;
		return $author_id;
	}

	/**
	 * Получить пост по урлу
	 *
	 * @param $slug
	 * @return \Illuminate\Database\Eloquent\Model|null
	 */
	public function getBySlug($slug)
	{
		$article = $this->model->where("slug", $slug)->with("author")->first();
		//$article = $this->model->where("slug", $slug)->with("author")->first();
		return $article;
	}

	/**
	 * Последние посты
	 *
	 * @param int $num
	 * @return \Illuminate\Database\Eloquent\Collection|static[]
	 */
	public function getLastArticles($num = 10)
	{
		return $this->model->notDraft()->with("author")->orderBy("published_at", "DESC")->limit($num)->get();
	}

}