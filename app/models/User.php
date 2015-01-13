<?php

use Illuminate\Auth\UserInterface;
<<<<<<< HEAD

class User extends \Eloquent implements UserInterface, RemindableInterface {

	protected   $hidden =       ['password', 'remember_token'];
=======
use Illuminate\Auth\Reminders\RemindableInterface;
use Laracasts\Presenter\PresentableTrait; // https://github.com/laracasts/Presenter

/**
 * User
 *
 * @property integer $id
 * @property Carbon\Carbon $created_at
 * @property Carbon\Carbon $updated_at
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property string $last_login_at
 * @property int $is_confirmed
 * @property-read Illuminate\Database\Eloquent\Collection|Post[] $posts
 * @method static Illuminate\Database\Query\Builder|User whereId($value)
 * @method static Illuminate\Database\Query\Builder|User whereCreatedAt($value)
 * @method static Illuminate\Database\Query\Builder|User whereUpdatedAt($value)
 * @method static Illuminate\Database\Query\Builder|User whereName($value)
 * @method static Illuminate\Database\Query\Builder|User whereEmail($value)
 * @method static Illuminate\Database\Query\Builder|User wherePassword($value)
 * @method static Illuminate\Database\Query\Builder|User whereRememberToken($value)
 * @method static Illuminate\Database\Query\Builder|User whereLastLoginAt($value)
 */
class User extends Eloquent implements UserInterface, RemindableInterface {

	//use SoftDeletingTrait;
	use PresentableTrait;

	protected $table = 'users';
	protected $guarded = [];
	protected $hidden = ['password', 'remember_token'];
	protected $presenter = 'LaravelRU\User\Presenters\UserPresenter';
>>>>>>> 54f09da6ce9ac5009c314d8debc50ebbcac69208

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
<<<<<<< HEAD
		return $this->hasOne("Confirmation")->orderBy('created_at','DESC');
=======
		return $this->hasOne('UserConfirmation', 'user_id')->orderBy('created_at', 'DESC');
>>>>>>> 54f09da6ce9ac5009c314d8debc50ebbcac69208
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
<<<<<<< HEAD
		$roles = $this->roles->lists("name");

		if(in_array($role, $roles))	return true;

		return false;
=======
		$roles = $this->roles->lists('name');

		return in_array($role, $roles);
>>>>>>> 54f09da6ce9ac5009c314d8debc50ebbcac69208
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

<<<<<<< HEAD
};
=======
	/**
	 * Presenters
	 */

	public function displayProfile()
	{
		return '<a class="user" href="' . route('user.profile', [$this->name]) . '">' . $this->name . '</a>';
	}

}
>>>>>>> 54f09da6ce9ac5009c314d8debc50ebbcac69208
