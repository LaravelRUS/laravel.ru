<?php namespace SU\User\Models;

use Hash;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Auth\UserInterface;
use Laracasts\Presenter\PresentableTrait; // https://github.com/laracasts/Presenter

class User extends \Eloquent implements UserInterface, RemindableInterface {

	protected   $table =        'users';
	protected   $primaryKey =   'id';
	public      $timestamps =   true;

	protected   $fillable =     [];
    protected   $guarded =      [];
    protected   $hidden =       ['password'];

//	use         SoftDeletingTrait;
//	protected   $dates =        ['deleted_at'];

	use         PresentableTrait;
	protected   $presenter =    '\SU\User\Presenters\UserPresenter';

	public static function boot()
	{
		parent::boot();
		// Setup event bindings...
	}

	// Автохэширование пароля
	public function setPasswordAttribute($password)
	{
		$this->attributes['password'] = Hash::make($password);
	}

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the token value for the "remember me" session.
	 *
	 * @return string
	 */
	public function getRememberToken()
	{
		return $this->remember_token;
	}

	/**
	 * Set the token value for the "remember me" session.
	 *
	 * @param  string  $value
	 * @return void
	 */
	public function setRememberToken($value)
	{
		$this->remember_token = $value;
	}

	/**
	 * Get the column name for the "remember me" token.
	 *
	 * @return string
	 */
	public function getRememberTokenName()
	{
		return 'remember_token';
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

	// ===========================================================================================

	public function posts()
	{
		return $this->hasMany('SU\Post\Models\Post', "author_id")->orderBy('published_at','DESC');
	}
};