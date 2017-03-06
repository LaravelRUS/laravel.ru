<?php

/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Console\Commands;

use Service\WebSocket\Server;
use Illuminate\Console\Command;
use Illuminate\Contracts\Container\Container;

/**
 * Class StartWebSocketServer.
 */
class StartWebSocketServer extends Command
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
     * @param  Container         $app
     * @throws \RuntimeException
     */
    public function handle(Container $app)
    {
        $this->info('Starting a WebSocket server');

        $server = Server::new($app, (int) env('WEBSOCKET_PORT', 8080), env('WEBSOCKET_HOST', '127.0.0.1'));
        $server->run();
    }
}
