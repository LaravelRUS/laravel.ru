<?php

/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Config\Repository;

/**
 * Class SphinxDaemon.
 */
class SphinxDaemon extends Command
{
    /**
     * The name and signature of the console command.
     * @var string
     */
    protected $signature = 'sphinx:run';

    /**
     * The console command description.
     * @var string
     */
    protected $description = '';

    /**
     * @param Repository $conf
     */
    public function handle(Repository $conf)
    {
        $cmd = sprintf(
            '%s --config "%s"',
            $conf->get('sphinx.searchd'),
            $conf->get('sphinx.conf')
        );

        system($cmd);
    }
}
