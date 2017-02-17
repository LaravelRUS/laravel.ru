<?php

/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Http\Middleware;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Symfony\Component\HttpFoundation\Response;

class CurrentPageState
{
    public const PAGE_NAME = 'pageFrom';

    /** @var \Illuminate\Routing\Route */
    private $current;

    /**
     * List of excluded route names
     *
     * @var array
     */
    private $exclude = [
        'login',
        'registration'
    ];

    /** @var Session */
    private $session;

    /** @var Authenticatable */
    private $user;

    public function __construct(Router $router, Session $session, Authenticatable $user = null)
    {
        $this->current = $router->current();
        $this->session = $session;
        $this->user = $user;
    }

    public function handle(Request $request, \Closure $next): Response
    {
        if (!$this->session->has(static::PAGE_NAME)) {
            $this->session->put(static::PAGE_NAME, '/');
        }

        $response = $next($request);

        if ($this->user === null) {
            $this->storeRoute($request);
        }

        return $response;
    }

    private function storeRoute(Request $request): void
    {
        if (in_array($this->current->getName(), $this->exclude, true)){
            return;
        }

        $this->session->put(static::PAGE_NAME, $request->getPathInfo());
    }
}
