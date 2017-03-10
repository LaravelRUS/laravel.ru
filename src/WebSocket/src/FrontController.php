<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Service\WebSocket;

use Psr\Log\LoggerInterface;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;
use Illuminate\Foundation\Application;
use Folklore\GraphQL\GraphQLController;
use Service\WebSocket\Io\WebSocketRequest;
use Service\WebSocket\Io\WebSocketResponse;
use Illuminate\Contracts\Container\Container;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Class FrontController.
 */
class FrontController implements MessageComponentInterface
{
    /**
     * @var \SplObjectStorage
     */
    protected $clients;

    /**
     * @var GraphQLController
     */
    private $gql;

    /**
     * @var \Illuminate\Log\Writer|LoggerInterface
     */
    private $log;

    /**
     * Server constructor.
     *
     * @param Application     $app
     * @param LoggerInterface $logger
     */
    public function __construct(Application $app, LoggerInterface $logger)
    {
        $this->gql = new GraphQLController();
        $this->clients = new \SplObjectStorage;
        $this->log = $logger;
    }

    /**
     * @param  Container $app
     * @param  int       $port
     * @param  string    $host
     * @return IoServer
     */
    public static function server(Container $app, int $port = 8080, string $host = '0.0.0.0'): IoServer
    {
        $serverName = self::getServerName();
        $app->make(LoggerInterface::class)
            ->info("Launching ${serverName} websocket server on ws(s)://${host}:${port}");

        $ws = new LaravelWsServer($app->make(static::class));

        $http = new HttpServer($ws);

        return IoServer::factory($http, $port, $host);
    }

    /**
     * @return string
     */
    private static function getServerName(): string
    {
        return interface_exists(ConnectionInterface::class)
            ? \Ratchet\VERSION
            : 'undefined';
    }


    /**
     * @param ConnectionInterface $conn
     */
    public function onOpen(ConnectionInterface $conn)
    {
        $this->info($conn, 'New connection establish');

        $this->clients->attach($conn);
    }

    /**
     * @param ConnectionInterface $from
     * @param string              $message
     */
    public function onMessage(ConnectionInterface $from, $message): void
    {
        $this->info($from, ' -> input: ' . $message);

        try {
            $request = WebSocketRequest::make(route('graphql.query'), $message);

            try {
                $data = $this->gql->query($request);

                $response = (string)WebSocketResponse::fromArrayResponse($request, $data);

                $this->info($from, ' <- output: ' . $response);
                $from->send($response);

            } catch (HttpException $e) {
                $this->error($from, $e);

                $from->send(WebSocketResponse::fromArrayResponse($request), [
                    'errors' => [$e->getMessage()],
                ]);
            }

        } catch (\Exception $e) {
            $this->onError($from, $e);

        } catch (\Throwable $e) {
            $this->onThrowable($from, $e);
        }
    }

    /**
     * @param ConnectionInterface $from
     * @param string              $message
     */
    protected function info(ConnectionInterface $from, string $message): void
    {
        $this->log->info("{$message} [conn: {$from->resourceId}]");
    }

    /**
     * @param ConnectionInterface $from
     * @param \Throwable          $error
     */
    protected function error(ConnectionInterface $from, \Throwable $error): void
    {
        $message = 'Runtime error [conn: ' . $from->resourceId . ']' . "\n" .
            '  > ' . get_class($error) . ': ' . $error->getMessage() . "\n" .
            '  > in ' . $error->getFile() . ':' . $error->getLine() . "\n" .
            $error->getTraceAsString() . "\n" .
            str_repeat('-', 80);

        $this->log->error($message);
    }

    /**
     * @param ConnectionInterface $conn
     * @param \Exception          $e
     */
    public function onError(ConnectionInterface $conn, \Exception $e): void
    {
        $this->onThrowable($conn, $e);
    }

    /**
     * @param ConnectionInterface $conn
     * @param \Throwable          $e
     */
    protected function onThrowable(ConnectionInterface $conn, \Throwable $e): void
    {
        $this->error($conn, $e);

        $conn->close();
    }

    /**
     * @param ConnectionInterface $conn
     */
    public function onClose(ConnectionInterface $conn): void
    {
        $this->info($conn, 'Disconnected');

        $this->clients->detach($conn);
    }
}
