<?php
/*
|--------------------------------------------------------------------------
| Helpers
|--------------------------------------------------------------------------
*/

HTML::macro('social', function ($key, $user)
{
	if ($info = $user->social->{$key})
	{
		return $info;
	}
});

if ( ! function_exists('avatar_path'))
{
	/**
	 * Return user avatar path
	 *
	 * @param string $image
	 * @return string
	 */
	function avatar_path($image = '')
	{
		return Config::get('users.avatar_base_url') . $image;
	}
}

if ( ! function_exists('gravatar'))
{
	/**
	 * Return Gravatar image url
	 *
	 * @param string $email
	 * @return string
	 */
	function gravatar($email)
	{
		return 'http://www.gravatar.com/avatar/' . md5((string) $email) . '?s=256' . '&d=' . urlencode(asset('img/avatar.png'));
	}
}
