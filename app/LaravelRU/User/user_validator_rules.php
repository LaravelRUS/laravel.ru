<?php
/** @var \Illuminate\Validation\Factory $validator */

$validator->extend('social', function ($attribute, $value, $parameters)
{
	return preg_match('/' . Config::get("social_regexp.{$parameters[0]}") . '/u', trim($value));
});
