<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Application;
use Monolog\Handler\StreamHandler;
use Psr\Log\LoggerInterface;

/**
 * Class AbstractCommand.
 */
abstract class AbstractCommand extends Command
{
    /**
     * @param Application $app
     */
    protected function bootLogger(Application $app)
    {
        if ($app->isLocal()) {
            $app->make(LoggerInterface::class)
                ->getMonolog()
                ->pushHandler(new StreamHandler('php://stdout'));
        }
    }
}
