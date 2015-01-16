<?php namespace LaravelRU\Likes\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model {

	public function likeable()
	{
		return $this->morphTo();
	}

	public function author()
	{
		return $this->belongsTo('LaravelRU\User\Models\User', 'author_id');
	}

}