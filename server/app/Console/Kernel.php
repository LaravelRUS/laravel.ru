<?php

/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

/**
 * Class Kernel.
 *
 * Это основной класс всех консольных команд.
 * Зачем и для чего он можно найти в документации.
 *
 * @see https://laravel.com/docs/5.4/lifecycle#lifecycle-overview
 */
class Kernel extends ConsoleKernel
{
    /**
     * Все консольные команды регистрируются в этом поле.
     *
     * @see https://laravel.com/docs/5.4/artisan
     * @var array
     */
    protected $commands = [
        Commands\IdeHelperRun::class,
        Commands\ArticlesImport::class,
        Commands\GitHubDocsSync::class,
    ];

    /**
     * Тут регистрируются команды, которые будут выполняться раз в определённый промежуток времени.
     *
     * @see https://laravel.com/docs/5.4/scheduling
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('articles:import')
            ->hourly();

        $schedule->command('docs:sync')
            ->dailyAt('01:01');
    }

    /**
     * Регистрация команд, основанных на замыканиях.
     *
     * @see https://laravel.com/docs/5.4/artisan#closure-commands
     */
    protected function commands(): void
    {
        require base_path('routes/console.php');
    }
}
