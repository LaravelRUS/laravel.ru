<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;


class User extends \Eloquent implements UserInterface, RemindableInterface {

	protected   $hidden =       ['password', 'remember_token'];

	protected $guarded = [];

	/**
	 * Автохэширование пароля
	 *
	 * @param string $password
	 */
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
	 * @param  string $value
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

	/**
	 * Ralations
	 */

	public function roles()
	{
		return $this->belongsToMany('Role', 'user_role_pivot', 'user_id', 'role_id');
	}

	public function posts()
	{
		return $this->hasMany('Post', 'author_id')->orderBy('published_at', 'DESC');
	}

	public function tips()
	{
		return $this->hasMany('Tip', 'author_id')->orderBy('published_at', 'DESC');
	}

	public function news()
	{
		return $this->hasMany('News', 'author_id')->orderBy('created_at', 'DESC');
	}

	public function confirmation()
	{

		return $this->hasOne("Confirmation")->orderBy('created_at','DESC');
	}

	/**
	 * Properties
	 */

	/**
	 * @param $role
	 *
	 * @return bool
	 */
	public function hasRole($role)
	{

		$roles = $this->roles->lists("name");

		if(in_array($role, $roles))	return true;

		return false;
	}

	public function isActive()
	{
		return $this->is_confirmed;
	}

	public function isAdmin()
	{
		return $this->hasRole('administrator');
	}

	public function isModerator()
	{
		return $this->hasRole('moderator');
	}

	public function isLibrarian()
	{
		return $this->hasRole('librarian');
	}

}
