<?php

/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

use Faker\Factory;
use App\Models\Tip;
use App\Models\User;
use App\Models\TipRating;
use Illuminate\Database\Seeder;

/**
 * Class TipsSeeder.
 */
class TipsSeeder extends Seeder
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
        Tip::truncate();
        TipRating::truncate();

        $users = User::all()->pluck('id')->toArray();

        foreach (range(0, 99) as $i) {
            $tip = Tip::create([
                'user_id'        => $this->faker->randomElement($users),
                'content_source' => $this->faker->text(200),
            ]);

            echo ' - ' . $i . ': ' . $tip->content_source . "\n";

            $ratings = range(0, random_int(1, count($users)));
            foreach ($ratings as $j) {
                try {
                    $rating = TipRating::create([
                        'type'    => $this->faker->randomElement(Tip\RatingType::getAll()),
                        'tip_id'  => $tip->id,
                        'user_id' => $this->faker->randomElement($users),
                    ]);

                    echo '   - ' . $j . ($rating->type === Tip\RatingType::LIKE ? '+' : '-') .
                        ' ' . $rating->id . ' <-> ' . $tip->id . "\n";
                } catch (Throwable $e) {
                    echo 'ERROR: ' . $e->getMessage() . "\n";
                }
            }
        }
    }
}
