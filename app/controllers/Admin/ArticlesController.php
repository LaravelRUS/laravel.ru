<?php namespace Admin;

class ArticlesController extends BaseController
{
	protected $modelClassName = 'LaravelRU\Articles\Models\Article';

	public function index()
	{
		return $this->response->data([
			'data' => $this->model->withVersion()->get(),
			'total' => $this->model->count(),
		]);
	}

	public function show($id)
	{
		return $this->response->data([
			'data' => $this->model->withVersion()->find($id),
		]);
	}

	public function remove($id)
	{
		$article = $this->model->findOrFail($id);

		if ( ! $article->delete())
		{
			return $this->response->error("Something went wrong when deleting article with ID {$id}");
		}

		return $this->response->message('Article successfully deleted');
	}

	public function store()
	{

	}

	public function update($id)
	{

	}
}
