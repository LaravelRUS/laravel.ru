<?php

/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Routing\Router;
use Illuminate\Contracts\Session\Session;
use Illuminate\Contracts\Auth\Authenticatable;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class CurrentPageState.
 */
class CurrentPageState
{
    public const PAGE_NAME = 'pageFrom';

    /**
     * @var Route
     */
    private $current;

    /**
     * List of excluded route names.
     *
     * @var array
     */
    private $exclude = [
        'login',
        'registration',
    ];

    /**
     * @var Session
     */
    private $session;

    /**
     * @var Authenticatable
     */
    private $user;

    /**
     * CurrentPageState constructor.
     *
     * @param Router $router
     * @param Session $session
     * @param Authenticatable|null $user
     */
    public function __construct(Router $router, Session $session, Authenticatable $user = null)
    {
        $this->current = $router->current();
        $this->session = $session;
        $this->user = $user;
    }

    /**
     * @param Request $request
     * @param \Closure $next
     *
     * @return Response
     */
    public function handle(Request $request, \Closure $next): Response
    {
        if (! $this->session->has(static::PAGE_NAME)) {
            $this->session->put(static::PAGE_NAME, '/');
        }

        $response = $next($request);

        if ($this->user === null) {
            $this->storeRoute($request);
        }

        return $response;
    }

    /**
     * @param Request $request
     */
    private function storeRoute(Request $request): void
    {
        if (in_array($this->current->getName(), $this->exclude, true)) {
            return;
        }

        $this->session->put(static::PAGE_NAME, $request->getPathInfo());
    }
}
