<?php

/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;

/**
 * Class IdeHelperRun.
 *
 * Класс запсукает все команды ide-helper пакета.
 * Просто для хелпер, чтобы не париться и упростить генерацию.
 */
class IdeHelperRun extends Command
{
    /**
     * Основное приложение. Оно есть в базовой команде, но там не работает автокомплит.
     * по-этому переопределим его тут. Мешать не будет, а автокомплит появится.
     *
     * @var \Illuminate\Foundation\Application
     */
    protected $laravel;

    /**
     * Название нашей консольной команды.
     *
     * @var string
     */
    protected $signature = 'ide-helper:run';

    /**
     * Краткое описание нашей консольной команды.
     *
     * @var string
     */
    protected $description = 'Generate a IDE Helper files if current environment is local.';

    /**
     * Метод выполняет саму команду, которая генерирует хелперы для IDE.
     * Помимо этого добавим проверку на окружение. На боевом сервере эти хелперы просто не нужны.
     *
     * @return void
     */
    public function handle(): void
    {
        if (! $this->laravel->getProvider(IdeHelperServiceProvider::class)) {
            $env = $this->laravel->environment();
            $this->info(sprintf('Skipped. IdeHelper not registered for %s environment.', $env));

            return;
        }

        $this->call('ide-helper:generate');
        $this->call('ide-helper:meta');
        $this->call('ide-helper:models', ['--nowrite' => null]);
    }
}
