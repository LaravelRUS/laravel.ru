<?php
/**
 * Типовые реакции на эксепшны
 */

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Laracasts\Validation\FormValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

// Ошибка валидации формы
App::error(function (FormValidationException $e)
{
	if (Request::ajax())
	{
		return App::make('app.response')->error('Исправьте ошибки в форме')->errors($e->getErrors());
	}

	return Redirect::back()->withInput()->withErrors($e->getErrors());
});

// Ошибка доступа
App::error(function (AccessDeniedException $e)
{
	if (Request::ajax())
	{
		// TODO json вывод для ошибки доступа
		return null;
	}

	return Response::view('errors.403', [], 403);
});

// 404
App::error(function (NotFoundHttpException $e)
{
	if (Request::ajax())
	{
		// TODO json вывод для 404
		return null;
	}

	return Response::view('errors.404', [], 404);
});

// Model Not Found
App::error(function (ModelNotFoundException $e)
{
	if (Request::ajax())
	{
		// TODO json вывод для 404
		return null;
	}

	return Response::view('errors.404', [], 404);
});
