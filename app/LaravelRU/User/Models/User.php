<?php namespace LaravelRU\User\Models;

use Laracasts\Presenter\PresentableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Auth\UserInterface;

/**
 * Class User
 *
 * @package LaravelRU\User\Models
 * @property int            $id
 * @property string         $username
 * @property string         $email
 * @property string         $password
 * @property bool           $is_confirmed
 * @property \Carbon\Carbon $last_login_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class User extends \Eloquent implements UserInterface, RemindableInterface {

	use PresentableTrait;

	/**
	 * The name of the "published at" column.
	 *
	 * @var string
	 */
	const PUBLISHED_AT = 'published_at';

	protected $hidden = ['password', 'remember_token'];

	protected $guarded = [];

	protected $presenter = 'LaravelRU\User\Presenters\UserPresenter';

	/**
	 * Автохэширование пароля
	 *
	 * @param string $password
	 */
	public function setPasswordAttribute($password)
	{
		$this->attributes['password'] = bcrypt($password);
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
	 * Get the token value for the 'remember me' session.
	 *
	 * @return string
	 */
	public function getRememberToken()
	{
		return $this->remember_token;
	}

	/**
	 * Set the token value for the 'remember me' session.
	 *
	 * @param  string $value
	 * @return void
	 */
	public function setRememberToken($value)
	{
		$this->remember_token = $value;
	}

	/**
	 * Get the column name for the 'remember me' token.
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
		return $this->belongsToMany('LaravelRU\Access\Models\Role', 'user_role', 'user_id', 'role_id');
	}

	public function articles()
	{
		return $this->hasMany('LaravelRU\Articles\Models\Article', 'author_id')
			->orderBy(static::PUBLISHED_AT, 'desc');
	}

	public function tips()
	{
		return $this->hasMany('LaravelRU\Tips\Models\Tip', 'author_id')
			->orderBy(static::PUBLISHED_AT, 'desc');
	}

	public function news()
	{
		return $this->hasMany('LaravelRU\News\Models\News', 'author_id')
			->orderBy(static::CREATED_AT, 'desc');
	}

	public function confirmation()
	{
		return $this->hasOne('LaravelRU\User\Models\Confirmation')
			->orderBy(static::CREATED_AT, 'desc');
	}

	/**
	 * User Social Networks
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function social()
	{
		return $this->hasOne('LaravelRU\User\Models\UserSocialNetwork');
	}

	/**
	 * User additional info
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function info()
	{
		return $this->hasOne('LaravelRU\User\Models\UserInfo');
	}

	/**
	 * User comments
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function comments()
	{
		return $this->hasMany('LaravelRU\Comment\Models\Comment', 'author_id');
	}

	/**
	 * Properties
	 */

	/**
	 * @param $role
	 * @return bool
	 */
	public function hasRole($role)
	{
		$roles = $this->roles->lists('name');

		return in_array($role, $roles);
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

	public function getAvatarAttribute()
	{
		return 'http://www.gravatar.com/avatar/' . md5($this->email) . '?s=256' . '&d=' . urlencode(app('url')->asset('img/avatar.png'));
	}

	public function scopeUsername($query, $username)
	{
		return $query->where('username', $username);
	}

	public function scopeWithRoles($query)
	{
		return $query->with('roles');
	}

	public function scopeWithInfo($query)
	{
		return $query->with('info');
	}

	public function scopeWithSocial($query)
	{
		return $query->with('social');
	}

	public function scopeWithLatestArticles($query, $num = 10)
	{
		return $query->with([
			'articles' => function ($q) use ($num)
			{
				return $q->limit($num);
			}
		]);
	}

}
