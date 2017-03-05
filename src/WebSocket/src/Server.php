<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Service\WebSocket;

use Illuminate\Foundation\Application;
use Monolog\Handler\StreamHandler;
use Psr\Log\LoggerInterface;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;
use Folklore\GraphQL\GraphQLController;
use Illuminate\Contracts\Container\Container;

/**
 * Class Server.
 */
class Server implements MessageComponentInterface
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
    private $logs;

    /**
     * Server constructor.
     * @param Application $app
     * @throws \Exception
     */
    public function __construct(Application $app)
    {
        $this->clients = new \SplObjectStorage;
        $this->gql = new GraphQLController();

        $this->logs = $app->make('log');

        if ($app->isLocal()) {
            $this->logs->getMonolog()->pushHandler(new StreamHandler('php://stdout'));
        }
    }

    /**
     * @param Container $app
     * @param int       $port
     * @param string    $host
     * @return IoServer
     */
    public static function new(Container $app, int $port = 8080, string $host = '0.0.0.0'): IoServer
    {
        $ws = new WsServer($app->make(static::class));

        $http = new HttpServer($ws);

        return IoServer::factory($http, $port, $host);
    }

    /**
     * @param ConnectionInterface $conn
     */
    public function onOpen(ConnectionInterface $conn)
    {
        $this->logs->info("New connection establish {$conn->resourceId}");

        $this->clients->attach($conn);
    }

    /**
     * @param ConnectionInterface $from
     * @param string              $message
     */
    public function onMessage(ConnectionInterface $from, $message): void
    {
        $this->logs->info("Input message {$message} from {$from->resourceId}");

        try {
            $request = json_decode($message, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \InvalidArgumentException('Json decode error: ' . json_last_error_msg());
            }

            $wsRequest = new WebSocketRequest($request);

            $response = $this->gql->query($wsRequest->toHttpRequest());

            $from->send(json_encode([
                'id'     => $wsRequest->getRequestId(),
                'data'   => $response['data'] ?? [],
                'errors' => $response['errors'] ?? [],
            ]));

        } catch (\Exception $e) {
            $this->onError($from, $e);

        } catch (\Throwable $e) {
            $this->onError($from, new \ErrorException($e->getMessage(), $e->getCode()));
        }
    }

    /**
     * @param ConnectionInterface $conn
     * @param \Exception          $e
     */
    public function onError(ConnectionInterface $conn, \Exception $e): void
    {
        $class = get_class($e);

        $this->logs->error("{$class}: {$e->getMessage()}\n{$e->getTraceAsString()}");

        $conn->close();
    }

    /**
     * @param ConnectionInterface $conn
     */
    public function onClose(ConnectionInterface $conn): void
    {
        $this->logs->info("Disconnected {$conn->resourceId}");

        $this->clients->detach($conn);
    }
}