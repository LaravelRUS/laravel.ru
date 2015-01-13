<?php

use Illuminate\Database\Eloquent\Model;

class Document extends Model {

	const LAST_COMMIT_AT = 'last_commit_at';

	protected $dates = [
		'last_commit_at',
		'last_original_commit_at',
		'current_original_commit_at'
	];

	public function scopeVersion($query, $version)
	{
		if ($version instanceof Version)
		{
			return $query->where('version_id', $version->id);
		}

		return $query->whereHas('frameworkVersion', function ($q) use ($version)
		{
			return $q->whereIteration($version);
		});
	}

	public function scopeName($query, $name)
	{
		return $query->whereName($name);
	}

	public function scopeOrderByLastCommit($query)
	{
		return $query->orderBy(self::LAST_COMMIT_AT, 'desc');
	}

	public function frameworkVersion()
	{
		return $this->belongsTo('Version', 'version_id');
	}

	/**
	 * Presenters
	 */

	public function displayText()
	{
		$parsedown = new Parsedown();
		$text = $this->text;
		$html = $parsedown->text($text);

		return $html;
	}

	public function displayUpdatedAt()
	{
		return $this->last_commit_at->format('d M');
	}

}
