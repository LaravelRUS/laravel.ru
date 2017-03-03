<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types = 1);

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class CorsMiddleware
 */
class CorsMiddleware
{
    private const ORIGIN_REQUEST = 1;
    private const ORIGIN_ANY     = 2;
    private const ORIGIN_LARAVEL = 4;
    private const ORIGIN_NONE    = 8;

    /**
     * @var array
     */
    private $allowedMethods = [
        'GET',
        'PUT',
        'POST',
        'HEAD',
        'PATCH',
        'DELETE',
        'OPTIONS',
    ];

    /**
     * @var array
     */
    private $allowedHeaders = [
        'X-Key',
        'X-Api-Token',
        'X-Access-Token',
        'X-Requested-With',
        'X-Requested-With',

        'DNT',
        'Host',
        'Pragma',
        'Origin',
        'Accept',
        'Referer',
        'Connection',
        'User-Agent',
        'Keep-Alive',
        'Content-Type',
        'Cache-Control',
        'Authorization',
        'Accept-Charset',
        'Content-Length',
        'Accept-Encoding',
        'Accept-Language',
        'If-Modified-Since',
    ];

    /**
     * @param Request  $request
     * @param \Closure $next
     * @return Response
     * @throws \InvalidArgumentException
     */
    public function handle(Request $request, \Closure $next)
    {
        $response = $next($request);

        if ($response instanceof Response) {
            $response = $this->injectHeaders($request, $response);
        }

        return $response;
    }

    /**
     * @param Request  $request
     * @param Response $response
     * @return Response
     * @throws \InvalidArgumentException
     */
    private function injectHeaders(Request $request, Response $response)
    {
        $response->headers->add([
            // Disable all cache
            'Cache-Control'                    => 'private, no-cache, no-store, must-revalidate',
            // Echo domain
            'Access-Control-Allow-Origin'      => $this->getAccessControlAllowOrigin($request, self::ORIGIN_REQUEST),
            // Send allowed headers
            'Access-Control-Allow-Headers'     => implode(',', $this->allowedHeaders),
            // Send allowed methods
            'Access-Control-Allow-Methods'     => implode(',', $this->allowedMethods),
            // Allow credentials
            'Access-Control-Allow-Credentials' => 'true',
            // No P3P policy (?)
            'P3P'                              => 'policyref="/w3c/p3p.xml", ' .
                'CP="NON DSP COR CUR ADM DEV PSA PSD OUR UNR BUS UNI COM NAV INT DEM STA"',
            // Blocks api queries into iframes
            'X-Frame-Options'                  => 'DENY',
            // Disable autodetect Content-Type
            'X-Content-Type-Options'           => 'nosniff',
            // Api responses into IE? o_0 Why not? :D
            'X-Xss-Protection'                 => '0',
        ]);

        return $response;
    }

    /*
     * @param Request $request
     * @param int $mode
     * @return string
     * @throws \InvalidArgumentException
     */
    private function getAccessControlAllowOrigin(Request $request, int $mode = self::ORIGIN_REQUEST): string
    {
        switch ($mode) {
            case self::ORIGIN_REQUEST:
                $headers = $request->headers;
                $referer = $headers->get('Referer', '*');

                return $this->parseUrl($headers->get('Origin', $referer));

            case self::ORIGIN_ANY:
                return '*';

            case self::ORIGIN_NONE:
                return '';

            case self::ORIGIN_LARAVEL:
                return '*.laravel.su';
        }

        throw new \InvalidArgumentException('Invalid CORS mode');
    }

    /**
     * @param string $url
     * @return string
     */
    private function parseUrl(string $url): string
    {
        if ($url === '*') {
            return '*';
        }

        $scheme = parse_url($url, PHP_URL_SCHEME) ?: 'http';
        $host   = parse_url($url, PHP_URL_HOST);
        $port   = parse_url($url, PHP_URL_PORT) ?: 80;

        return $scheme . '://' . $host . ($port !== 80 ? ':' . $port : '');
    }
}
