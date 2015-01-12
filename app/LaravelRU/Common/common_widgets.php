<?php

/**
 * Пункт меню со ссылкой на роут и подсветкой (.active) если мы сейчас в этом роуте
 * Требует "pingpong/widget" : "1.0.*"
 */
Widget::register('li', function ($anchor, $routeDestination, $routeMatch = '')
{
	$html = '<a href="' . route($routeDestination) . '">' . $anchor . '</a>';

	if ( ! $routeMatch)
	{
		$class = activeByRoute($routeDestination);
	}
	else
	{
		$class = activeByRoute($routeMatch);
	}

	$html = "<li class=\"$class\">$html</li>";

	return $html;
});
