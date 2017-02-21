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

            echo ' - ' . $i . ': ' . $article->title . "\n";
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
            if (random_int(0, 4) > 2) {
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
        $level = random_int(1, 6);

        return "\n" .
            str_repeat('#', $level) . ' ' .
            $this->faker->words(random_int(1, 12), true) . "\n";
    }

    /**
     * @return string
     */
    private function createList(): string
    {
        $listSize = random_int(2, 10);

        $result = [];
        for ($i = 0; $i < $listSize; $i++) {
            $result[] = (random_int(0, 5) && $i !== 0 > 4 ? '  ' : '') .
                '- ' . $this->faker->words(random_int(1, 12), true);
        }

        return implode("\n", $result) . "\n";
    }

    /**
     * @return string
     */
    private function createQuote(): string
    {
        return '> ' . $this->faker->sentences(random_int(1, 4), true) . "\n";
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

        return "\n" . '```' . "\n" .
            $sources . "\n" .
        '```';
    }

    /**
     * @param  int          $count
     * @param  bool         $asString
     * @return array|string
     */
    private function sentences(int $count = 3, bool $asString = false)
    {
        $pattern = '/\.\?!/u';

        $sentences = preg_split($pattern,
            'Родился на улице Герцена, в гастрономе № 22. Известный экономист, по призванию своему — библиотекарь. ' .
            'В народе — колхозник. В магазине — продавец. В экономике, так сказать, необходим. ' .
            'Это, так сказать, система… эээ… в составе 120 единиц. Фотографируете Мурманский полуостров и ' .
            'получаете te-le-fun-ken. И бухгалтер работает по другой линии — по линии библиотекаря. ' .
            'Потому что не воздух будет, академик будет! Ну вот можно сфотографировать Мурманский полуостров. ' .
            'Можно стать воздушным асом. Можно стать воздушной планетой. И будешь уверен, что эту планету примут по ' .
            'учебнику. Значит, на пользу физики пойдет одна планета. Величина, оторванная в область дипломатии, дает ' .
            'свои колебания на всю дипломатию. А Илья Муромец дает колебания только на семью на свою. ' .
            'Спичка в библиотеке работает. В кинохронику ходят и зажигают в кинохронике большой лист. ' .
            'В библиотеке маленький лист разжигают. Огонь… эээ… будет вырабатываться гораздо легче, ' .
            'чем учебник крепкий. А крепкий учебник будет весомее, чем гастроном на улице Герцена. ' .
            'А на улице Герцена будет расщепленный учебник. Тогда учебник будет проходить через улицу ' .
            'Герцена, через гастроном № 22, и замещаться там по формуле экономического единства. ' .
            'Вот в магазине 22 она может расщепиться, экономика! На экономистов, на диспетчеров, ' .
            'на продавцов, на культуру торговли… Так что, в эту сторону двинется вся экономика. ' .
            'Библиотека двинется в сторону 120 единиц, которые будут… эээ… предмет укладывать на предмет. ' .
            '120 единиц — предмет физика. Электрическая лампочка горит от 120 кирпичей, потому что структура, ' .
            'так сказать, похожа у неё на кирпич. Илья Муромец работает на стадионе «Динамо». ' .
            'Илья Муромец работает у себя дома. Вот конкретная дипломатия! «Открытая дипломатия» — то же самое. ' .
            'Ну, берем телевизор, вставляем в Мурманский полуостров, накручиваем там… эээ… все время чёрный хлеб… ' .
            'Так что же, будет Муромец, что ли, вырастать? Илья Муромец, что ли, будет вырастать из этого?'
        );

        $random = $this->faker->randomElements($sentences, $count);

        return $asString ? implode('.', $random) : $random;
    }
}
