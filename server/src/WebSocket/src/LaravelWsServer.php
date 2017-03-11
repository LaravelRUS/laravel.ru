<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Service\WebSocket;

use Ratchet\WebSocket\WsServer;
use Ratchet\ConnectionInterface;
use Guzzle\Http\Message\RequestInterface;
use Service\WebSocket\Io\WebSocketRequest;
use Guzzle\Http\Message\EntityEnclosingRequest;

/**
 * Class LaravelHttpServer.
 */
class LaravelWsServer extends WsServer
{
    /**
     * @param ConnectionInterface                     $conn
     * @param RequestInterface|EntityEnclosingRequest $request
     * @throws \UnexpectedValueException
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     */
    public function onOpen(ConnectionInterface $conn, RequestInterface $request = null): void
    {
        if ($request === null) {
            throw new \InvalidArgumentException('Broken request');
        }

        try {
            $http = WebSocketRequest::make($request->getPath(), $request->getParams()->toArray());

            $this->check($http);

        } catch (\Throwable $e) {
            parent::close($conn);
        }

        parent::onOpen($conn, $request);
    }

    /**
     * @param WebSocketRequest $request
     * @return mixed|\Symfony\Component\HttpFoundation\Response
     */
    private function check(WebSocketRequest $request)
    {
        return app(Kernel::class)->handle($request);
    }
}
