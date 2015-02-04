<?php

function activeClassName($route)
{
	return (Route::currentRouteName() == $route) ? 'active' : null;
}

function activeClass($routes = [])
{
	return (in_array(Route::currentRouteName(), $routes)) ? 'class="active"' : null;
}

function navMargin()
{
	return in_array(Route::currentRouteName(), ['home', 'documentation', 'documentation.status']) ? 'class="no-margin"' : null;
}