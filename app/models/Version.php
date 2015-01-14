<?php

use Illuminate\Database\Eloquent\Model;

/**
 * Class Version
 *
 * @property int $id
 * @property string $number
 * @property int $is_default
 * @property int $is_master
 */
class Version extends Model {

	const MASTER = 'master';

	public $timestamps = false;

	public function posts()
	{
		return $this->hasMany('Post');
	}

	public function documents()
	{
		return $this->hasMany('Document');
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

	function __toString()
	{
		return $this->number;
	}

}
