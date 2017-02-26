<?php

/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Article;
use App\Models\Bot;
use App\Services\DataProviders\DataProviderInterface;
use App\Services\DataProviders\ExternalArticle;
use App\Services\DataProviders\Manager;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * Class DataProvidersImport.
 */
class DataProvidersImport extends Command
{
    /**
     * The name and signature of the console command.
     * @var string
     */
    protected $signature = 'data-providers:import';

    /**
     * The console command description.
     * @var string
     */
    protected $description = 'Run import articles from external services';

    /**
     * @var array
     */
    private $published = [];

    /**
     * @param  Manager $manager
     * @throws \InvalidArgumentException
     */
    public function handle(Manager $manager)
    {
        //$this->importPublished($manager);

        $this->importNotPublished($manager);
    }

    /**
     * @param Manager $manager
     * @return void
     */
    private function importNotPublished(Manager $manager): void
    {
        foreach ($manager as $alias => $provider) {
            if (in_array($alias, $this->published, true)) {
                continue;
            }

            $this->import(Carbon::createFromTimestamp(0), $provider);
        }
    }

    /**
     * @param \DateTime             $time
     * @param DataProviderInterface $provider
     */
    private function import(\DateTime $time, DataProviderInterface $provider)
    {
        /** @var ExternalArticle[] $latest */
        $latest = $provider->getLatest($time);

        foreach ($latest as $external) {
            $article = new Article();

            $article->user_id = 1;
            $article->user_type = Bot::class;

            $external->fill($article);

            $article->save();
        }
    }

    /**
     * @param Manager $manager
     * @throws \InvalidArgumentException
     * @return void
     */
    private function importPublished(Manager $manager): void
    {
        /** @var Article $article */
        foreach ($this->getLatestBotArticles() as $article) {
            /** @var Bot $bot */
            $bot = $article->user;

            $this->import($article->published_at, $manager->get($bot->provider));

            $this->published[] = $bot->provider;
        }
    }

    /**
     * @return \Generator|Article[]
     */
    private function getLatestBotArticles(): \Generator
    {
        $bots = Bot::query()
            ->with(['articles' => function (MorphMany $relation) {
                return $relation->latest('published_at')->take(1);
            }])
            ->get();

        foreach ($bots as $bot) {
            $article = $bot->articles->first();

            if ($article) {
                yield $article;
            }
        }
    }
}
