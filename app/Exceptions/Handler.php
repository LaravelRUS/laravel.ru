<?php

/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Exceptions;

use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

/**
 * Class Handler.
 *
 * Класс обработки всех исключений в нашем приложении.
 * Тут мы их будем обрабатывать и отображать ошибки, в случае проблем.
 */
class Handler extends ExceptionHandler
{
    /**
     * Список исключений, которые являются частью нормальной работы приложения
     * и которые не надо как-то обрабатывать. Например, "ошибка 404" и прочие.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
    ];

    /**
     * Метод, куда прилетают все наши исключения для обработки.
     * Отличное место для отправки оных в Sentry, Bugsnag, и проч.
     *
     * @param  \Exception $exception
     * @throws \Exception
     */
    public function report(\Exception $exception): void
    {
        if ($this->shouldReport($exception)) {
            try {
                app('sentry')->captureException($exception);
            } catch (\Throwable $e) {
                parent::report($e);
            }
        }

        parent::report($exception);
    }

    /**
     * Отображение наших необработанных ошибок.
     *
     * @param  \Illuminate\Http\Request                            $request
     * @param  \Exception                                          $exception
     * @return Response|\Symfony\Component\HttpFoundation\Response
     */
    public function render($request, \Exception $exception)
    {
        return parent::render($request, $exception);
    }

    /**
     * Преобразовываем ошибки аутентификации в разлогинивающий ответ.
     *
     * @param  \Illuminate\Http\Request                 $request
     * @param  \Illuminate\Auth\AuthenticationException $exception
     * @return Response|RedirectResponse
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest('login')
            ->withException($exception);
    }
}
