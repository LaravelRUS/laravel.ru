<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Service\HeadersInjector;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class HeadersInjectorMiddleware.
 */
class HeadersInjectorMiddleware
{
    /**
     * @var HeadersInjectorRepository
     */
    private $repo;

    /**
     * HeadersInjectorMiddleware constructor.
     * @param HeadersInjectorRepository $repo
     */
    public function __construct(HeadersInjectorRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @param Request     $request
     * @param \Closure    $next
     * @param string|null $config
     * @return Response
     */
    public function handle(Request $request, \Closure $next, string $config = null)
    {
        /** @var Response $response */
        $response = $next($request);

        foreach ($this->repo->getHeaders($config) as $header => $configs) {
            $resolver = $this->repo->getHeaderValueResolver($header);

            foreach ($resolver->inject($request, $response, $header, $configs) as $headerName => $value) {
                $response->header($headerName, $value);
            }
        }

        return $response;
    }
}