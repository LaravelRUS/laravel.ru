<?php

use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Генерация блока breadcrubs
 * Использование: $items = ['Текст ссылки'=>'урл ссылки', ...]
 *
 * @param array $items
 *
 * @return string
 */
function breadcrumbs($items)
{
	$last_i = count($items) - 1;
	$output = '<ol class="breadcrumb">';
	$i = 0;

	foreach ($items as $text => $url)
	{
		if ($i == $last_i)
		{
			// Последний элемент
			$output .= "<li class=\"active\">$text</li>";
		}
		else
		{
			$output .= "<li><a href=\"$url\">$text</a></li>";
		}

		$i++;
	}

	$output .= '</ol>';

	return $output;
}

/**
 * Установить класс active для текущего пункта menu
 *
 * @param string $routeMatch
 *
 * @return string
 */
function activeByRoute($routeMatch)
{
	$pregRouteMatch = str_replace('.', '\.', $routeMatch);
	$pregRouteMatch = str_replace('*', '.*', $pregRouteMatch);
	$currentRoute = Route::currentRouteName();
	preg_match("/$pregRouteMatch/", $currentRoute, $match);

	if ( ! isset($match[0])) return false;

	if ($match[0] == $currentRoute)
	{
		return 'active';
	}

	return '';
}

if ( ! function_exists('view'))
{
	/**
	 * Get the evaluated view contents for the given view.
	 *
	 * @param  string $view
	 * @param  array $data
	 * @param  array $mergeData
	 * @return \Illuminate\View\View
	 */
	function view($view = null, $data = [], $mergeData = [])
	{
		$factory = app('Illuminate\View\Factory');

		if (func_num_args() === 0)
		{
			return $factory;
		}

		return $factory->make($view, $data, $mergeData);
	}
}

if ( ! function_exists('abort'))
{
	/**
	 * @param int $code
	 * @param string $message
	 * @return void
	 * @throws NotFoundHttpException, HttpException
	 */
	function abort($code = 404, $message = '')
	{
		if ($code == 404)
		{
			throw new NotFoundHttpException($message);
		}

		throw new HttpException($code, $message);
	}

}

if ( ! function_exists('json_response'))
{
	/**
	 * @return Vanchelo\AjaxResponse\Response
	 */
	function json_response()
	{
		return app('app.response');
	}
}

if ( ! function_exists('request'))
{
	/**
	 * @return \Illuminate\Http\Request
	 */
	function request()
	{
		return app('request');
	}
}

if ( ! function_exists('input'))
{
	/**
	 * @param string $key
	 * @param mixed $default
	 *
	 * @return array
	 */
	function input($key, $default = null)
	{
		return request()->input($key, $default);
	}
}

if ( ! function_exists('input_only'))
{
	/**
	 * @return array
	 */
	function input_only()
	{
		return request()->only(func_get_args());
	}
}

if ( ! function_exists('guard'))
{
	/**
	 * @return \Illuminate\Auth\Guard
	 */
	function auth()
	{
		return app('auth');
	}
}

if ( ! function_exists('user'))
{
	/**
	 * Get User
	 *
	 * @return User
	 */
	function user()
	{
		static $user;

		return $user ?: $user = auth()->user();
	}
}

if ( ! function_exists('du'))
{
	/**
	 * Dump the passed variables and end the script.
	 *
	 * @param mixed
	 * @return void
	 */
	function du()
	{
		array_map(function ($x)
		{
			dump($x);
		}, func_get_args());
		die;
	}
}

if ( ! function_exists('bcrypt'))
{
	/**
	 * Hash the given value.
	 *
	 * @param  string $value
	 * @param  array $options
	 * @return string
	 */
	function bcrypt($value, $options = [])
	{
		return app('hash')->make($value, $options);
	}
}

if ( ! function_exists('config'))
{
	/**
	 * Get / set the specified configuration value.
	 *
	 * If an array as passed as the key, we will assume you want to set an array of values.
	 *
	 * @param  array|string $key
	 * @param  mixed $default
	 * @return mixed
	 */
	function config($key, $default = null)
	{
		if (is_array($key))
		{
			return app('config')->set($key);
		}

		return app('config')->get($key, $default);
	}
}

if ( ! function_exists('info'))
{
	/**
	 * Write some information to the log.
	 *
	 * @param  string $message
	 * @param  array $context
	 * @return void
	 */
	function info($message, $context = [])
	{
		app('log')->info($message, $context);
	}
}

if ( ! function_exists('logger'))
{
	/**
	 * Log a debug message to the logs.
	 *
	 * @param  string $message
	 * @param  array $context
	 * @return void
	 */
	function logger($message, array $context = [])
	{
		app('log')->debug($message, $context);
	}
}

if ( ! function_exists('old'))
{
	/**
	 * Retrieve an old input item.
	 *
	 * @param  string $key
	 * @param  mixed $default
	 * @return mixed
	 */
	function old($key = null, $default = null)
	{
		return request()->old($key, $default);
	}
}


if ( ! function_exists('snake'))
{
	// Поддерживает русский язык
	function snake($value, $delimiter = '_')
	{
		if (preg_match("/[A-ZА-Я]/u", $value))
		{
			$replace = '$1'.$delimiter.'$2';

			$value = mb_strtolower(preg_replace('/(.)([A-ZА-Я])/u', $replace, $value), 'UTF-8');
		}

		return $value;
	}
}

if ( ! function_exists('redirect'))
{
	/**
	 * Get an instance of the redirector.
	 *
	 * @param  string|null  $to
	 * @param  int     $status
	 * @param  array   $headers
	 * @param  bool    $secure
	 * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
	 */
	function redirect($to = null, $status = 302, $headers = array(), $secure = null)
	{
		if (is_null($to)) return app('redirect');

		return app('redirect')->to($to, $status, $headers, $secure);
	}
}
