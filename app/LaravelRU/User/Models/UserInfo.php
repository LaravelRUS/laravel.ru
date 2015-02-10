<?php namespace LaravelRU\User\Models;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model {

	public $timestamps = false;

	protected $table = 'user_info';

	protected $guarded = [];

	public static function boot()
	{
		parent::boot();

		static::saving(function (self $model)
		{
			if ($model->isDirty('avatar') && is_null($model->avatar))
			{
				app('files')->delete(public_path(avatar_path($model->avatar)));
			}
		});
	}

	/**
	 * Ralations
	 */

	public function user()
	{
		return $this->belongsTo('LaravelRU\User\Models\User', 'user_id');
	}

	public function setAvatarAttribute($image)
	{
		if ($image instanceof \Intervention\Image\File)
		{
			$this->attributes['avatar'] = $image->filename . '.' . $image->extension;
		}
		else
		{
			$this->attributes['avatar'] = $image;
		}
	}

}
