<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Service\HeadersInjector\HeaderProviders;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class AccessControlAllowOrigin.
 */
class AccessControlAllowOrigin implements HeaderProviderInterface
{
    use OptionsSerializer;

    public const ORIGIN_ECHO = 1;
    public const ORIGIN_ALL = '*';
    public const ORIGIN_NONE = '';
    public const ORIGIN_LOCALHOST = ['*.localhost', 'localhost', 'localhost:*'];

    private const HEADER_NAME = 'Access-Control-Allow-Origin';

    /**
     * @param  string $headerName
     * @return bool
     */
    public function match(string $headerName): bool
    {
        return $headerName === self::HEADER_NAME;
    }

    /**
     * @param  Request $request
     * @param  Response|JsonResponse $response
     * @param  string $headerName
     * @param  mixed $options
     * @return \Generator
     * @throws \InvalidArgumentException
     */
    public function inject(Request $request, $response, string $headerName, $options): \Generator
    {
        yield $headerName => $this->getAccessControlAllowOrigin($request, $options);
    }

    /*
     * @param Request $request
     * @param int $mode
     * @return string
     * @throws \InvalidArgumentException
     */

    /**
     * @param  Request $request
     * @param                            $options
     * @return string
     * @throws \InvalidArgumentException
     */
    private function getAccessControlAllowOrigin(Request $request, $options): string
    {
        if ($options === self::ORIGIN_ECHO) {
            $headers = $request->headers;
            $referrer = $headers->get('Referer', '*');

            return $this->parseUrl($headers->get('Origin', $referrer));
        }

        return $this->serialize($options);
    }

    /**
     * @param  string $url
     * @return string
     */
    private function parseUrl(string $url): string
    {
        if ($url === '*') {
            return '*';
        }

        $scheme = parse_url($url, PHP_URL_SCHEME) ?: 'http';
        $host = parse_url($url, PHP_URL_HOST);
        $port = parse_url($url, PHP_URL_PORT) ?: 80;

        return $scheme . '://' . $host . ($port !== 80 ? ':' . $port : '');
    }
}
