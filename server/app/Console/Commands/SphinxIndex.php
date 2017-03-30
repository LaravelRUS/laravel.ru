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
 * Class SphinxIndex.
 */
class SphinxIndex extends Command
{
    /**
     * The name and signature of the console command.
     * @var string
     */
    protected $signature = 'sphinx:index';

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
            '%s --config "%s" --all --print-queries',
            $conf->get('sphinx.indexer'),
            $conf->get('sphinx.conf')
        );

        system($cmd);
    }
}
