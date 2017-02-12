<?php declare(strict_types=1);

use App\Models\Article;
use App\Models\User;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;

/**
 * Class ArticlesSeeder
 */
class ArticlesSeeder extends Seeder
{
    /**
     * @var Factory
     */
    private $faker;

    /**
     * ArticlesSeeder constructor.
     */
    public function __construct()
    {
        $this->faker = Factory::create('ru_RU');
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Article::truncate();

        $users = User::all();

        foreach (range(0, 99) as $i) {
            $article = Article::create([
                'user_id'        => $this->faker->randomElement($users->toArray())['id'],
                'title'          => $this->faker->words(random_int(1, 8), true),
                'image'          => $this->faker->randomElement(['1.png', '2.png', '3.png']),
                'content_source' => $this->faker->sentences(random_int(2, 15), true),
                'status'         => $this->faker->randomElement(['Draft', 'Review', 'Published']),
                'published_at'   => Carbon::now()
                    ->subDays(240)
                    ->addDays(random_int(0, 300))
            ]);

            echo ' - ' . $i . ': ' . $article->title . "\n";
        }
    }
}
