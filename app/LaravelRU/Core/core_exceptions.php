<?php
/**
 * Типовые реакции на эксепшны
 */

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Laracasts\Validation\FormValidationException;
use LaravelRU\Core\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

// Ошибка валидации формы
App::error(function (FormValidationException $e)
{
	if (Request::ajax())
	{
		return new JsonResponse(
			app('app.response')->error('Исправьте ошибки в форме')->errors($e->getErrors())
		);
	}

	return Redirect::back()->withInput()->withErrors($e->getErrors());
});

// Ошибка доступа
App::error(function (AccessDeniedException $e)
{
	if (Request::ajax())
	{
		return new JsonResponse(app('app.response')->error('Not found'), JsonResponse::HTTP_FORBIDDEN);
	}

	return Response::view('errors.403', [], JsonResponse::HTTP_FORBIDDEN);
});

// 404
App::error(function (NotFoundHttpException $e)
{
	if (Request::ajax())
	{
		return new JsonResponse(app('app.response')->error('Not found'), JsonResponse::HTTP_NOT_FOUND);
	}

	return Response::view('errors.404', [], JsonResponse::HTTP_NOT_FOUND);
});

// Model Not Found
App::error(function (ModelNotFoundException $e)
{
	if (Request::ajax())
	{
		return new JsonResponse(app('app.response')->error('Not found'), JsonResponse::HTTP_NOT_FOUND);
	}

	return Response::view('errors.404', [], JsonResponse::HTTP_NOT_FOUND);
});

// Validation exception
App::error(function (HttpResponseException $e)
{
	return $e->getResponse();
});
