<?php

class Document extends Eloquent {

	protected   $dates = ['last_commit_at', 'last_original_commit_at', 'current_original_commit_at'];

	public function scopeVersion($query, $version)
	{
		return $query->where('framework_version', '=', $version);
	}

	public function scopeName($query, $name)
	{
		return $query->where('name', '=', $name);
	}
}