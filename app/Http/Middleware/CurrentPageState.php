<?php declare(strict_types=1);
/**
 * This file is part of laravel.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace App\Http\Middleware;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Router;

/**
 * Class CurrentPageState
 * @package App\Http\Middleware
 */
class CurrentPageState
{
    public const PAGE_NAME = 'pageFrom';

    /**
     * @var \Illuminate\Routing\Route
     */
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
     * @param Router $router
     * @param Session $session
     * @param Authenticatable $user
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
     * @return Response|RedirectResponse
     */
    public function handle($request, \Closure $next)
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

    /**
     * @param Request $request
     */
    private function storeRoute(Request $request): void
    {
        if (in_array($this->current->getName(), $this->exclude, true)){
            return;
        }

        $this->session->put(static::PAGE_NAME, $request->getPathInfo());
    }
}