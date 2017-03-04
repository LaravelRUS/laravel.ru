<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Service\HeadersInjector\HeaderProviders;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class AsIs.
 */
class AsIs implements HeaderProviderInterface
{
    use OptionsSerializer;

    /**
     * @param string $headerName
     * @return bool
     * @throws \BadMethodCallException
     */
    public function match(string $headerName): bool
    {
        return true;
    }

    /**
     * @param Request  $request
     * @param Response $response
     * @param string   $headerName
     * @param mixed    $options
     * @return \Generator
     * @throws \InvalidArgumentException
     */
    public function inject(Request $request, Response $response, string $headerName, $options): \Generator
    {
        yield $headerName => $this->serialize($options);
    }
}