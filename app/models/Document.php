<?php

use Illuminate\Database\Eloquent\Model;

/**
 * Class Document
 *
 * @property int $id
 * @property string $title
 * @property string $name
 * @property string $text
 * @property string $last_commit
 * @property string $last_original_commit
 * @property string $current_original_commit
 * @property \Carbon\Carbon $last_commit_at
 * @property \Carbon\Carbon $last_original_commit_at
 * @property \Carbon\Carbon $current_original_commit_at
 * @property int $original_commits_ahead
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $version_id
 */
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
			return $q->whereNumber($version);
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
