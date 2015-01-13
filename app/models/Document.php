<?php

class Document extends Eloquent {

	protected   $dates = ['last_commit_at', 'last_original_commit_at', 'current_original_commit_at'];

	public function scopeVersion($query, $version)
	{
		return $query->whereHas('frameworkVersion', function($q) use ($version)
		{
			return $q->whereIteration($version);
		});
	}

	public function scopeName($query, $name)
	{
		return $query->where('name', '=', $name);
	}

	public function frameworkVersion()
	{
		return $this->belongsTo('Version', 'version_id');
	}
}