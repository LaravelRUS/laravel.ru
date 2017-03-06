<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Service\WebSocket;

use Illuminate\Http\Request;

/**
 * Class Request.
 */
class WebSocketRequest
{
    /**
     * Request constructor.
     * @param  array                                                                    $data
     * @throws \Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return int
     */
    public function getRequestId(): int
    {
        return (int) ($this->data['id'] ?? 0);
    }

    /**
     * @return Request
     */
    public function toHttpRequest(): Request
    {
        return Request::create(route('graphql.query'), 'POST', $this->data);
    }
}
