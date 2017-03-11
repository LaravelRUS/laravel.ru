<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Console\Commands;

use Psr\Log\LoggerInterface;
use Illuminate\Console\Command;
use Monolog\Handler\StreamHandler;
use Illuminate\Foundation\Application;

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
