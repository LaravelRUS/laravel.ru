<?php namespace Admin;

use URL;
use View;

class RestrictedWordsController extends BaseController {

	protected $modelClassName = 'LaravelRU\Core\Models\RestrictedWord';

	public function index()
	{
		if ( ! $this->request->ajax())
		{
			return View::make('admin.restricted-words.index');
		}

		return $this->response->data([
			'data' => $this->model->get()
		]);
	}

	public function show($id)
	{
		return View::make('admin.restricted-words.show')
			->with('word', $this->model->findOrFail($id));
	}

	public function edit($id)
	{
		return View::make('admin.restricted-words.edit')
			->with('word', $this->model->findOrFail($id));
	}

	public function create()
	{
		return View::make('admin.restricted-words.create');
	}

	public function remove($id)
	{
		$word = $this->model->findOrFail($id);

		if ( ! $word->delete())
		{
			return $this->response->error("Something went wrong when deleting word with ID {$id}");
		}

		return $this->response->message('Restricted word successfully deleted');
	}

	public function store()
	{
		$this->validate($this->request, [
			'title' => 'required|min:2|unique:restricted_words'
		]);

		$word = $this->model->newInstance();
		$word->title = trim($this->request->input('title'));
		$word->save();

		return $this->response->data([
			'title' => 'Новое слово успешно добавлено!',
			'redirect' => route('admin.restricted-words.index')
		]);
	}

	public function update($id)
	{
		$word = $this->model->findOrFail($id);

		$this->validate($this->request, [
			'title' => "required|min:2|unique:restricted_words,title,{$id}"
		]);

		$word->title = trim($this->request->input('title'));
		$word->save();

		return $this->response->data([
			'title' => 'Слово успешно обновлено!',
			'redirect' => URL::route('admin.restricted-words.index')
		]);
	}
}
