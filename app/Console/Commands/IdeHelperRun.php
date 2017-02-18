<?php

/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Console\Commands;

use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Illuminate\Console\Command;

/**
 * Class IdeHelperRun
 *
 * @package App\Console\Commands
 */
class IdeHelperRun extends Command
{
    /**
     * @var \Illuminate\Foundation\Application
     */
    protected $laravel;

    /**
     * @var string
     */
    protected $signature = 'ide-helper:run';

    /**
     * @var string
     */
    protected $description = 'Generate a IDE Helper files if current environment is local.';

    /**
     * @return void
     */
    public function handle(): void
    {
        if (!$this->laravel->getProvider(IdeHelperServiceProvider::class)) {
            $env = $this->laravel->environment();
            $this->info(sprintf('Skipped. IdeHelper not registered for %s environment.', $env));

            return;
        }

        $this->call('ide-helper:generate');
        $this->call('ide-helper:meta');
        $this->call('ide-helper:models', ['--nowrite' => null]);
    }
}
