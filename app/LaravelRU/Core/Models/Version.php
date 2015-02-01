<?php namespace LaravelRU\Core\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Version
 *
 * @property int    $id
 * @property string $number
 * @property int    $is_default
 * @property int    $is_master
 * @property string $number_alias
 */
class Version extends Model {

	const MASTER = 'master';

	public $timestamps = false;

	public function articles()
	{
		return $this->hasMany('LaravelRU\Articles\Models\Article');
	}

	public function documentation()
	{
		return $this->hasMany('LaravelRU\Docs\Models\Documentation');
	}

	public function tips()
	{
		return $this->hasMany('LaravelRU\Tips\Models\Tip');
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
