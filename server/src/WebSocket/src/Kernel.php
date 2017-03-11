<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Service\WebSocket;

use Illuminate\Http\Response;
use Illuminate\Routing\Route;
use Illuminate\Routing\Router;
use Illuminate\Pipeline\Pipeline;
use App\Http\Kernel as HttpKernel;

/**
 * Class Kernel.
 */
class Kernel extends HttpKernel
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return mixed
     * @throws \InvalidArgumentException
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function handle($request)
    {
        return $this->sendRequestThroughRouter($request);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return mixed
     * @throws \InvalidArgumentException
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    protected function sendRequestThroughRouter($request)
    {
        /** @var Route $route */
        $route = $this->findRouteByRequest($request);

        /**
         * TODO A тут нанига не работает, ибо... =\
         * <code>
         * Error {
         *    #message: "Call to a member function parameters() on null"
         *    #code: 0
         *    #file: "~/new.laravel.su/vendor/laravel/framework/src/Illuminate/Routing/Router.php"
         *    #line: 616
         *    -trace: {
         *        ~/new.laravel.su/vendor/laravel/framework/src/Illuminate/Routing/Router.php:616: {
         *              : {
         *         -->> :     foreach ($route->parameters() as $key => $value) {
         *              :         if (isset($this->binders[$key])) {
         *        }
         *    }
         * </code>.
         */

        return true;

        $middleware = $this->router->gatherRouteMiddleware($route);

        return (new Pipeline($this->app))
            ->send($request)
            ->through(array_merge($this->middleware, $middleware))
            ->then(function () use ($route) {
                return new Response($route->getAction());
            });
    }

    /**
     * @param $request
     * @return Route
     */
    private function findRouteByRequest($request): Route
    {
        return $this->routeFinderResolver()
            ->call($this->router, $request);
    }

    /**
     * @return \Closure
     */
    private function routeFinderResolver(): \Closure
    {
        return function ($request): Route {
            /** @var Router $this */
            return $this->findRoute($request);
        };
    }
}
