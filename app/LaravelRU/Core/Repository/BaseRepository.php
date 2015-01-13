<?php namespace LaravelRU\Core\Repository;

use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository {

	/**
	 * @var Model
	 */
	protected $model;

	/**
	 * @param Model $model
	 */
	public function __construct(Model $model = null)
	{
		$this->model = $model;
	}

	/**
	 * @return Model
	 */
	public function getModel()
	{
		return $this->model;
	}

	/**
	 * @param Model $model
	 */
	public function setModel($model)
	{
		$this->model = $model;
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Collection|static[]
	 */
	public function all()
	{
		return $this->model->all();
	}

	/**
	 * Find model by ID
	 *
	 * @param int $id
	 *
	 * @return Model|null
	 */
	public function find($id)
	{
		return $this->model->find($id);
	}

	/**
	 * Find model by ID
	 *
	 * @param int $id
	 *
	 * @return Model|null
	 */
	public function getById($id)
	{
		return $this->find($id);
	}

	/**
	 * @param array $attributes
	 *
	 * @return Model
	 */
	public function create($attributes = [])
	{
		return $this->model->newInstance($attributes);
	}

	/**
	 * Save model or create new from attributes
	 *
	 * @param Model|array $data
	 *
	 * @return bool|mixed
	 */
	public function save($data)
	{
		if ($data instanceOf Model)
		{
			return $this->storeEloquentModel($data);
		}
		elseif (is_array($data))
		{
			return $this->storeArray($data);
		}
	}

	/**
	 * Delete model
	 *
	 * @param Model $model
	 *
	 * @return bool
	 */
	public function delete($model)
	{
		return $model->delete();
	}

	/**
	 * @param Model $model
	 *
	 * @return bool
	 */
	protected function storeEloquentModel($model)
	{
		if ($model->getDirty())
		{
			return $model->save();
		}
		else
		{
			return $model->touch();
		}
	}

	/**
	 * @param array $data
	 *
	 * @return bool|mixed
	 */
	protected function storeArray($data)
	{
		/** @var Model $model */
		$model = $this->create($data);
		$isSaved = $this->storeEloquentModel($model);

		if ($isSaved)
		{
			return $model->getKey();
		}

		return false;
	}

}
