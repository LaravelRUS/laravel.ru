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
	function avatar_path($image = '')
	{
		return Config::get('users.avatar_base_url') . $image;
	}
}
