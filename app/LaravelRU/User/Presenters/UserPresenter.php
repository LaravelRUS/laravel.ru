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
		return LocalizedCarbon::createFromFormat('Y-m-d', $this->info->birthday)->formatLocalized('%e %f %Y');
	}

	/**
	 * @param \Carbon\Carbon $date
	 * @return mixed|string
	 */
	private function localizedDate($date)
	{
		if ( ! $date || $date->year < 0) return '&mdash;';

		return LocalizedCarbon::instance($date)->formatLocalized('%e %f %Y в %H:%M');
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
