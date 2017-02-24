<?php

/**
 * This file is part of laravel.su package.
 *
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

/**
 * Class DataProvidersImport.
 */
class DataProvidersImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data-providers:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run import articles from external services';

    /**
     * @var array
     */
    private $published = [];

    /**
     * @param Manager $manager
     * @throws \InvalidArgumentException
     */
    public function handle(Manager $manager)
    {
        $a = Article::publishedByBot()
            ->with('user')
            ->latest('published_at')
            ->first();

        $articles = (array)($a ?? []);

        /** @var Article $article */
        foreach ($articles as $article) {
            /** @var Bot $bot */
            $bot = $article->user;

            $this->import($article->published_at, $manager->get($bot->provider));

            $this->published[] = $bot->provider;
        }

        $this->importNotPublished($manager);
    }

    /**
     * @param Manager $manager
     */
    private function importNotPublished(Manager $manager)
    {
        foreach ($manager as $alias => $provider) {
            if (in_array($alias, $this->published, true)) {
                continue;
            }

            $this->import(Carbon::createFromTimestamp(0), $provider);
        }
    }

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
}
