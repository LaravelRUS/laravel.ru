<?php namespace LaravelRU\User\Presenters;

use Laracasts\Presenter\Presenter;
use LocalizedCarbon;

class UserPresenter extends Presenter {

	protected static $dates = ['last_activity_at', 'last_login_at', 'created_at'];

	public function fullname()
	{
		if ( ! $this->info->name && ! $this->info->surname) return $this->entity->username;

		return $this->info->name . ' ' . $this->info->surname;
	}

	public function birthday()
	{
		return $this->localizedDate($this->info->birthday, '%e %f %Y');
	}

	/**
	 * @param \Carbon\Carbon $date
	 * @param string $format
	 * @return mixed|string
	 */
	public function localizedDate($date, $format = '%e %f %Y в %H:%M')
	{
		if ( ! $date || $date->year < 0) return '&mdash;';

		return LocalizedCarbon::instance($date)->formatLocalized($format);
	}

	/**
	 * Allow for property-style retrieval
	 *
	 * @param $property
	 * @return mixed
	 */
	public function __get($property)
	{
		if (method_exists($this, $property))
		{
			return $this->{$property}();
		}

		if (in_array($property, self::$dates))
		{
			return $this->localizedDate($this->entity->{$property});
		}

		return $this->entity->{$property};
	}

}
