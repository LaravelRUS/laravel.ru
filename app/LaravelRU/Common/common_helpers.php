<?php

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
