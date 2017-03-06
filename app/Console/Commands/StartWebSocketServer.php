<?php

/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Console\Commands;

use Service\WebSocket\FrontController;
use Illuminate\Foundation\Application;

/**
 * Class StartWebSocketServer.
 */
class StartWebSocketServer extends AbstractCommand
{
    /**
     * The name and signature of the console command.
     * @var string
     */
    protected $signature = 'ws:start';

    /**
     * The console command description.
     * @var string
     */
    protected $description = 'Start a web socket server';

    /**
     * @param  Application $app
     * @throws \RuntimeException
     * @throws \Exception
     */
    public function handle(Application $app)
    {
        $this->bootLogger($app);

        [$host, $port] = [
            env('WEBSOCKET_HOST', '127.0.0.1'),
            (int) env('WEBSOCKET_PORT', 8080)
        ];

        $server = FrontController::server($app, $port, $host);

        $server->run();
    }
}
