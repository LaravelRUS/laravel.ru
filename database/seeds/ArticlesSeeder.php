<?php

declare(strict_types=1);

use Carbon\Carbon;
use Faker\Factory;
use App\Models\User;
use App\Models\Article;
use Illuminate\Database\Seeder;
use Symfony\Component\Finder\Finder;

/**
 * Class ArticlesSeeder.
 */
class ArticlesSeeder extends Seeder
{
    /**
     * @var Factory
     */
    private $faker;

    /**
     * @var \Symfony\Component\Finder\SplFileInfo[]
     */
    private $files;

    /**
     * ArticlesSeeder constructor.
     *
     * @throws \InvalidArgumentException
     */
    public function __construct()
    {
        $this->files = iterator_to_array(
            (new Finder())
                ->in(base_path())
                ->name('*.php')
                ->files()
        );

        $this->faker = Factory::create('ru_RU');
    }

    /**
     * Run the database seeds.
     */
    public function run()
    {
        Article::truncate();

        $users = User::all();

        foreach (range(0, 99) as $i) {
            $article = Article::create([
                'user_id'        => $this->faker->randomElement($users->toArray())['id'],
                'title'          => $this->faker->words(random_int(1, 8), true),
                'image'          => $this->faker->randomElement([
                    '1.png',
                    '2.png',
                    '3.png',
                    '4.png',
                    '5.png',
                    '6.png',
                ]),
                'content_source' => $this->createContent(),
                'status'         => $this->faker->randomElement(['Draft', 'Review', 'Published']),
                'published_at'   => Carbon::now()
                    ->subDays(240)
                    ->addDays(random_int(0, 300)),
            ]);

            echo ' - '.$i.': '.$article->title."\n";
        }
    }

    /**
     * @return string
     */
    private function createContent(): string
    {
        $paragraphsCount = random_int(2, 40);

        $result = [];

        for ($j = 0; $j < $paragraphsCount; ++$j) {
            if (random_int(0, 4) > 3) {
                $result[] = $this->createTitle();
            }

            if (random_int(0, 9) > 8) {
                $result[] = $this->createList();
            }

            if (random_int(0, 4) > 3) {
                $result[] = $this->createQuote();
            }

            if (random_int(0, 8) > 7) {
                $result[] = $this->createCode();
            }

            $result[] = $this->createParagraph();
        }

        return implode("\n", $result);
    }

    /**
     * @return string
     */
    private function createParagraph(): string
    {
        return $this->faker->sentences(random_int(2, 15), true);
    }

    /**
     * @return string
     */
    private function createTitle(): string
    {
        $level = random_int(3, 6);

        return "\n".
            str_repeat('#', $level).' '.
            $this->faker->words(random_int(1, 12), true)."\n";
    }

    /**
     * @return string
     */
    private function createList(): string
    {
        $listSize = random_int(2, 10);

        $result = [];
        for ($i = 0; $i < $listSize; $i++) {
            $result[] = (random_int(0, 5) && $i !== 0 > 4 ? '  ' : '').
                '- '.$this->faker->words(random_int(1, 12), true);
        }

        return implode("\n", $result)."\n";
    }

    /**
     * @return string
     */
    private function createQuote(): string
    {
        return '> '.$this->faker->sentences(random_int(1, 4), true)."\n";
    }

    /**
     * @return string
     *
     * @throws \InvalidArgumentException
     */
    private function createCode(): string
    {
        $file = $this->faker->randomElement($this->files);
        $sources = $file->getContents();

        return "\n".'```'."\n".
            $sources."\n".
        '```';
    }
}
