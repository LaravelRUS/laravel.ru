<?php namespace LaravelRU\Core\Repository;

abstract class BaseRepository
{
	protected $model;

	public function __construct(\Eloquent $model = null)
	{
		$this->model = $model;
	}

	public function getModel()
	{
		return $this->model;
	}

	public function setModel($model)
	{
		$this->model = $model;
	}

	public function all()
	{
		return $this->model->all();
	}

	public function find($id)
	{
		return $this->model->find($id);
	}

	public function getById($id)
	{
		$this->find($id);
	}

	public function create($attributes = array())
	{
		return $this->model->newInstance($attributes);
	}

	public function save($data)
	{
		if ($data instanceOf Model) {
			return $this->storeEloquentModel($data);
		} elseif (is_array($data)) {
			return $this->storeArray($data);
		}
	}

	public function delete($model)
	{
		return $model->delete();
	}

	protected function storeEloquentModel($model)
	{
		if ($model->getDirty()) {
			return $model->save();
		} else {
			return $model->touch();
		}
	}

	protected function storeArray($data)
	{
		$model = $this->getNew($data);
		$isSaved = $this->storeEloquentModel($model);
		if($isSaved) return $model->getKey();
		else return false;
	}
} 