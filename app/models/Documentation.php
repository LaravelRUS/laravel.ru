<?php

use Laracasts\Presenter\PresentableTrait;
use LaravelRU\Comment\CommentableTrait;
use Illuminate\Database\Eloquent\Model;

class Documentation extends Model {

	use CommentableTrait, PresentableTrait;

	const LAST_COMMIT_AT = 'last_commit_at';

	protected $table = 'documentation';

	protected $dates = [
		'last_commit_at',
		'last_original_commit_at',
		'current_original_commit_at'
	];

	protected $presenter = 'LaravelRU\Docs\Presenters\DocsPresenter';

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

	public function scopePage($query, $pageTitle)
	{
		return $query->wherePage($pageTitle);
	}

	public function scopeOrderByLastCommit($query)
	{
		return $query->orderBy(self::LAST_COMMIT_AT, 'desc');
	}

	public function frameworkVersion()
	{
		return $this->belongsTo('Version', 'version_id');
	}

}
