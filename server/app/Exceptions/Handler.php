<?php

/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Exceptions;

use Whoops\Run;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Whoops\Handler\PrettyPageHandler;
use Illuminate\Auth\AuthenticationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

/**
 * Class Handler.
 * Класс обработки всех исключений в нашем приложении.
 * Тут мы их будем обрабатывать и отображать ошибки, в случае проблем.
 */
class Handler extends ExceptionHandler
{
    /**
     * Список исключений, которые являются частью нормальной работы приложения
     * и которые не надо как-то обрабатывать. Например, "ошибка 404" и прочие.
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
     * @param  \Exception $exception
     * @throws \Exception
     */
    public function report(\Exception $exception): void
    {
        if ($this->shouldReport($exception) && app('app')->bound('sentry')) {
            app('sentry')->captureException($exception);
        }

        parent::report($exception);
    }

    /**
     * Отображение наших необработанных ошибок.
     * @param \Illuminate\Http\Request $request
     * @param \Exception $exception
     * @return string|\Symfony\Component\HttpFoundation\Response
     * @throws \Throwable
     * @throws \InvalidArgumentException
     */
    public function render($request, \Exception $exception)
    {
        $exception = $this->prepareException($exception);

        $htmlAccepted = ! $request->ajax() && $request->acceptsHtml();

        if ($htmlAccepted && config('app.debug')) {
            $whoops = new Run();
            $whoops->pushHandler(new PrettyPageHandler());

            return $whoops->handleException($exception);
        }

        if (! $this->isHttpException($exception)) {
            $exception = new HttpException(500, $exception->getMessage(), $exception);
        }

        if ($request->ajax() || $request->acceptsJson()) {
            return new JsonResponse($this->getError($exception), $exception->getStatusCode());
        }

        return response($this->getErrorView($exception)->render(), $exception->getStatusCode());
    }

    /**
     * @param HttpException $exception
     * @return array
     */
    private function getError(HttpException $exception): array
    {
        if (config('app.debug')) {
            return $this->getDebugError($exception);
        }

        return [
            'message' => Response::$statusTexts[$exception->getStatusCode()],
            'code'    => $exception->getStatusCode(),
        ];
    }

    /**
     * @param HttpException $exception
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    private function getErrorView(HttpException $exception)
    {
        return view('layout.error', array_merge($this->getError($exception), [
            'error' => $exception,
        ]));
    }

    /**
     * Преобразовываем ошибки аутентификации в разлогинивающий ответ.
     * @param  \Illuminate\Http\Request $request
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

    /**
     * @param HttpException $exception
     * @return array
     */
    private function getDebugError(HttpException $exception): array
    {
        $trace = $exception->getPrevious()
            ? $exception->getPrevious()->getTraceAsString()
            : $exception->getTraceAsString();

        return [
            'message' => $exception->getMessage(),
            'code'    => $exception->getStatusCode(),
            'trace'   => explode("\n", $trace),
        ];
    }
}
