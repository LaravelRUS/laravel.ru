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
 * Interface HeaderProviderInterface.
 */
interface HeaderProviderInterface
{
    /**
     * @param  string $headerName
     * @return bool
     */
    public function match(string $headerName): bool;

    /**
     * @param  Request $request
     * @param  Response|JsonResponse $response
     * @param  string $headerName
     * @param  mixed $options
     * @return \Generator
     */
    public function inject(Request $request, $response, string $headerName, $options): \Generator;
}
