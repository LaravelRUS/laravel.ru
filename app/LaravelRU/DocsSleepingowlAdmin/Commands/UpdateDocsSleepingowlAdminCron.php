<?php namespace LaravelRU\DocsSleepingowlAdmin\Commands;

use Carbon\Carbon;
use Config;
use Github\Client as GithubClient;
use Github\Exception\RuntimeException;
use Guzzle\Http\Client as GuzzleClient;
use Indatus\Dispatcher\Drivers\Cron\Scheduler;
use Indatus\Dispatcher\Scheduling\Schedulable;
use Indatus\Dispatcher\Scheduling\ScheduledCommand;
use LaravelRU\Access\Models\Role;
use LaravelRU\Docs\Models\Documentation;
use LaravelRU\DocsSleepingowlAdmin\Models\DocumentationSleepingowlAdmin;
use LaravelRU\Github\GithubRepo;
use Laravelrus\LocalizedCarbon\Models\Eloquent;
use Log;
use Mail;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use LaravelRU\Core\Models\Version as FrameworkVersion;

class UpdateDocsSleepingowlAdminCron extends ScheduledCommand {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'su:update_docs_sleepingowl_admin';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Update SleepingOwl admin docs.';

	/**
	 * @var \LaravelRU\Github\GithubRepo
	 */
	private $github;

	private $branch;

	/**
	 * Create a new command instance.
	 */
	public function __construct()
	{
		parent::__construct();

		$this->github= new GithubRepo(
			Config::get('laravel.sleepingowl_admin_docs.user'),
			Config::get('laravel.sleepingowl_admin_docs.repository')
		);

		$this->branch = "master";
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		Eloquent::unguard();
		//date_default_timezone_set('UTC');
		Log::info('su:update_docs_sleepingowl_admin begin');

		$updatedOriginalDocs = [];

		$forceUpdate = $this->argument('force');
		//$force_file = $this->option('file');
		$isPretend = $this->option('pretend');

		if ($forceUpdate)
		{
			// удаляем все страницы
			DocumentationSleepingowlAdmin::where("id",">", 0)->delete();
		}


		$menu = $this->github->getFile($this->branch, "menu.md");
		$lines = explode("\n", $menu);
		$lines[] = "[Menu](menu)";

		foreach($lines as $line)
		{
			preg_match('/\((.*?)\)/im', $line, $matches);
			if(isset($matches[1]))
			{
				$name = $matches[1];
				$filename = $name . '.md';
				preg_match('/\[(.*?)\]/im', $line, $matches);
				$title = $matches[1];

				$this->line('');
				$this->line("Fetch {$filename}...");
				$this->line(' get last commit');
				$commit = $this->github->getLastCommit($this->branch, $filename);
				if ( ! is_null($commit))
				{
					$last_commit_id = $commit['sha'];
					$last_commit_at = Carbon::createFromTimestampUTC(
						strtotime($commit['commit']['committer']['date'])
					);

					$page = DocumentationSleepingowlAdmin::where('name', $name)->first();
					if($page)
					{
						if ($page->last_commit_at < $last_commit_at)
						{
							$this->line(" detected new commit $last_commit_at");
							$this->line(' get file');
							$content = $this->github->getFile($this->branch, $filename, $last_commit_id);
							$page->text = $content;
							$page->last_commit_id = $last_commit_id;
							$page->last_commit_at = $last_commit_at;
							if ( ! $isPretend)
							{
								$page->save();
								$this->line(' content saved ');
							}

						}
						else
						{
							$this->line(' no need to update');
						}

					}
					else
					{
						$this->line(" detected new file $filename");
						$this->line(' get file');
						$commit = $this->github->getLastCommit($this->branch, $filename);
						$last_commit_id = $commit['sha'];
						$last_commit_at = Carbon::createFromTimestampUTC(
							strtotime($commit['commit']['committer']['date'])
						);
						$content = $this->github->getFile($this->branch, $filename, $last_commit_id);
						$page = new DocumentationSleepingowlAdmin();
						$page->title = $title;
						$page->name = $name;
						$page->text = $content;
						$page->last_commit_id = $last_commit_id;
						$page->last_commit_at = $last_commit_at;
						if ( ! $isPretend)
						{
							$page->save();
							$this->line(' content saved ');
						}
					}
				}
			}
		}

		Log::info('su:update_docs_sleepingowl_admin end');
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return [
			['force', InputArgument::OPTIONAL, 'Delete all docs and replace by github data.'],
		];
	}

	protected function getOptions()
	{
		return [
			['pretend', null, InputOption::VALUE_NONE, 'Emulation only, without DB changes.', null],
		];
	}

	/**
	 * When a command should run
	 *
	 * @param Schedulable|Scheduler $scheduler
	 * @return \Indatus\Dispatcher\Scheduling\Schedulable
	 */
	public function schedule(Schedulable $scheduler)
	{
		return $scheduler->everyHours(1)->minutes(50);
	}

}
