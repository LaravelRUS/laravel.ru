<?php

/**
 * Class Version
 *
 * @property int    $id
 * @property string $number
 * @property int    $is_default
 * @property int    $is_master
 * @property string $number_alias
 */
class Version extends Eloquent {

	const MASTER = 'master';

	public $timestamps = false;

	public function posts()
	{
		return $this->hasMany('Post');
	}

	public function documentation()
	{
		return $this->hasMany('Documentation');
	}

	public function tips()
	{
		return $this->hasMany('Tip');
	}

	public function isMaster()
	{
		return (bool) $this->is_master;
	}

	public function isDefault()
	{
		return (bool) $this->is_default;
	}

	public function isDocumented()
	{
		return (bool) $this->is_documented;
	}

	public function getNumberAliasAttribute()
	{
		return $this->isMaster() ? self::MASTER : $this->number;
	}

	public function scopeMaster($query)
	{
		return $query->where('is_master', 1);
	}

	public function scopeDefault($query)
	{
		return $query->where('is_default', 1);
	}

	public function scopeDocumented($query)
	{
		return $query->where('is_documented', 1);
	}

	public function scopeWithDocumentation($query)
	{
		return $query->with([
			'documentation' => function ($q)
			{
				$q->orderBy('page');
			}
		]);
	}

	function __toString()
	{
		return $this->number;
	}

}
