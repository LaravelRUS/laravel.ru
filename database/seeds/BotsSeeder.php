<?php

/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

use Faker\Factory;
use App\Models\Bot;
use Illuminate\Database\Seeder;

/**
 * Class BotsSeeder.
 */
class BotsSeeder extends Seeder
{
    /**
     * @var Factory
     */
    private $faker;

    /**
     * ArticlesSeeder constructor.
     * @throws \InvalidArgumentException
     */
    public function __construct()
    {
        $this->faker = Factory::create('ru_RU');
    }

    /**
     * Run the database seeds.
     */
    public function run()
    {
        Bot::truncate();

        Bot::create([
            'name'     => 'Laravel News',
            'avatar'   => 'laravel-news.png',
            'provider' => 'laravel-news',
        ]);
    }
}
