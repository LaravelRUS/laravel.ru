<?php

declare(strict_types=1);

use App\Models\Article;
use App\Models\Tag;
use Faker\Factory;
use Illuminate\Database\Seeder;

/**
 * Class TagsSeeder.
 */
class TagsSeeder extends Seeder
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
        \DB::table('tags')->truncate();
        \DB::table('article_tags')->truncate();

        $articleIds = Article::all()->pluck('id')->toArray();

        foreach (range(0, 999) as $i) {
            try {
                $tag = Tag::create([
                    'name' => $this->faker->words(random_int(0, 8) ? 1 : 2, true),
                ]);

                echo ' - '.$i.': '.$tag->name."\n";

                foreach (range(0, random_int(1, count($articleIds))) as $j) {
                    $articleId = $this->faker->randomElement($articleIds);

                    \DB::table('article_tags')->insert([
                        'article_id' => $articleId,
                        'tag_id'     => $tag->id,
                    ]);

                    echo '   - '.$j.': '.$tag->id.' <-> '.$articleId."\n";
                }
            } catch (Throwable $e) {
                echo 'ERROR: '.$e->getMessage()."\n";
            }
        }
    }
}
