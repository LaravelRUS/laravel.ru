<?php

/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Bot;
use App\Models\Article;
use Illuminate\Console\Command;
use App\Services\DataProviders\Manager;
use App\Services\DataProviders\ExternalArticle;
use App\Services\DataProviders\DataProviderInterface;
use Illuminate\Contracts\Container\Container;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Service\WebSocket\Server;

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
     * @param Container $app
     * @throws \RuntimeException
     */
    public function handle(Container $app)
    {
        $this->info('Starting a WebSocket server');

        $server = Server::new($app);
        $server->run();
    }
}
