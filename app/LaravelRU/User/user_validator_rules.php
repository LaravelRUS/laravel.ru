<?php
/** @var \Illuminate\Validation\Factory $validator */

$validator->extend('social', function ($attribute, $value, $parameters)
{
	return preg_match('/' . Config::get("social_regexp.{$parameters[0]}") . '/u', trim($value));
});

$validator->extend('username', function ($attribute, $value, $parameters)
{
	return preg_match('/^\b[a-z\pN\-\_\.]+\b$/i', $value);
});

Validator::extend('password_check', function ($attribute, $value, $parameters)
{
	return Hash::check($value, Auth::user()->getAuthPassword());
});
