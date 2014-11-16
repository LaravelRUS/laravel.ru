<?php

use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Auth\UserInterface;
use Laracasts\Presenter\PresentableTrait; // https://github.com/laracasts/Presenter

/**
 * User
 *
 * @property integer $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property string $last_login_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Article[] $posts
 * @method static \Illuminate\Database\Query\Builder|\User whereId($value) 
 * @method static \Illuminate\Database\Query\Builder|\User whereCreatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\User whereUpdatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\User whereName($value) 
 * @method static \Illuminate\Database\Query\Builder|\User whereEmail($value) 
 * @method static \Illuminate\Database\Query\Builder|\User wherePassword($value) 
 * @method static \Illuminate\Database\Query\Builder|\User whereRememberToken($value) 
 * @method static \Illuminate\Database\Query\Builder|\User whereLastLoginAt($value) 
 */
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
	protected   $presenter =    '\LaravelRU\User\Presenters\UserPresenter';

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

	public function roles()
	{
		return $this->belongsToMany("Role","user_role_pivot","user_id","role_id");
	}

	public function articles()
	{
		return $this->hasMany('Article', "author_id")->orderBy('published_at','DESC')->limit(1);
	}

    // ===========================================================================================

	public function hasRole($role)
	{
		$roles = $this->roles->lists("name");
		if(in_array($role, $roles)){
			return true;
		}else{
			return false;
		}
	}

	public function isAdmin()
	{
		return $this->hasRole("administrator");
	}

	public function isModerator()
	{
		return $this->hasRole("moderator");
	}

	public function isLibrarian()
	{
		return $this->hasRole("librarian");
	}

	// ===========================================================================================

	public function displayProfileUrl()
	{
		return "<a class='user' href='".route("user.profile", [$this->name])."'>$this->name</a>";
	}

};