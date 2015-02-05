<?php namespace LaravelRU\Core\Models;

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class RestrictedWord extends \Eloquent {

	use SoftDeletingTrait;

	protected $dates = ['deleted_at'];

	protected $fillable = [
		'title'
	];

}
