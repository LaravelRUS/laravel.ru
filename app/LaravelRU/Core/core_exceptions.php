<?php
/**
 * Типовые реакции на эксепшны
 */

use Laracasts\Validation\FormValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

// Ошибка валидации формы
App::error(function (FormValidationException $e)
{
	if (Request::ajax())
	{
		// TODO json вывод для ошибок валидации форм (если надо)
		return null;
	}
	else
	{
		return Redirect::back()->withInput()->withErrors($e->getErrors());
	}
});

// Ошибка доступа
App::error(function (AccessDeniedException $e)
{
	if (Request::ajax())
	{
		// TODO json вывод для ошибки доступа
		return null;
	}
	else
	{
		return Response::view('errors.403', [], 403);
	}
});

// 404
App::error(function (NotFoundHttpException $e)
{
	if (Request::ajax())
	{
		// TODO json вывод для 404
		return null;
	}
	else
	{
		return Response::view('errors.404', [], 404);
	}
});
