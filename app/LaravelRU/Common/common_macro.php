<?php

function activeClassName($route)
{
	return (Route::currentRouteName() == $route) ? 'active' : null;
}

/**
 * @param array|string $routes
 * @return null|string
 */
function activeClass($routes = null)
{
	if ( ! is_array($routes)) $routes = func_get_args();

	return (in_array(Route::currentRouteName(), $routes)) ? 'class="active"' : null;
}

function navMargin()
{
	return in_array(Route::currentRouteName(), ['home', 'documentation', 'documentation.status']) ? 'class="no-margin"' : null;
}
