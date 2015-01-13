<?php namespace LaravelRU\Docs\Commands;


use Carbon\Carbon;
use Config;
use Document;
use Github\Client;
use Github\Exception\RuntimeException;
use Indatus\Dispatcher\Drivers\Cron\Scheduler;
use Indatus\Dispatcher\Scheduling\Schedulable;
use Indatus\Dispatcher\Scheduling\ScheduledCommand;
use LaravelRU\Github\GithubRepo;
use Laravelrus\LocalizedCarbon\Models\Eloquent;
use Log;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Version as FrameworkVersion;


class UpdateDocsCron extends ScheduledCommand {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'su:update_docs';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Update russian docs from translated github repo.';

	/**
	 * @var \LaravelRU\Github\GithubRepo
	 */
	private $githubTranslated;

	private $githubOriginal;

	/**
	 * Create a new command instance.
	 */
	public function __construct()
	{
		parent::__construct();

		$this->githubTranslated = new GithubRepo(
			Config::get('laravel.translated_docs.user'),
			Config::get('laravel.translated_docs.repository')
		);

		$this->githubOriginal = new GithubRepo(
			Config::get('laravel.original_docs.user'),
			Config::get('laravel.original_docs.repository')
		);
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		Eloquent::unguard();

		$github = new Client();
		$http = new \Guzzle\Http\Client();
		Log::info("su:update_docs begin");

		$forceupdate = $this->argument("force");
		$force_branch = $this->option("branch");
		$force_file = $this->option("file");

		if ($force_branch)
		{
			$all_versions[] = FrameworkVersion::where('is_master', 1)->first();
		}
		else
		{
			$all_versions = FrameworkVersion::all();
		}

		/** @var FrameworkVersion $v */
		foreach ($all_versions as $v)
		{
			$id = $v->id;
			$version = $v->isMaster() ? FrameworkVersion::MASTER : $v->iteration;

			$this->info("Process branch $version");

			if ($force_file)
			{
				if ($forceupdate)
				{
					Document::whereHas('version')->name($force_file)->delete();
					$this->info("clear exist file $force_file !");
				}

				$lines = ["[File](/docs/$version/$force_file)"];
			}
			else
			{
				if ($forceupdate)
				{
					Document::version($version)->delete();
					$this->info("clear exist {$version} docs!");
				}

				$this->line('Fetch documentation.md');
				$content = $this->githubTranslated->getFile($version, 'documentation.md');
				$lines = explode("\n", $content);
				$lines[] = "[Menu](/docs/$version/documentation)";
			}

			$matches = [];
			foreach ($lines as $line)
			{
				try
				{
					preg_match('/\(\/docs\/(.*?)\/(.*?)\)/im', $line, $matches);

					if (isset($matches[2]))
					{
						$name = $matches[2];
						$filename = $name . '.md';
						$this->line('');
						$this->line("Fetch {$filename}...");
						$this->line(' get last translated commit');
						$commit = $this->githubTranslated->getLastCommit($version, $filename);

						if ( ! is_null($commit))
						{
							$last_commit_id = $commit['sha'];
							$last_commit_at = Carbon::createFromTimestampUTC(
								strtotime($commit['commit']['committer']['date'])
							);
							$this->line(' get file');
							$content = $this->githubTranslated->getFile($version, $filename, $last_commit_id);
							if ( ! is_null($content))
							{
								preg_match('/git (.*?)$/m', $content, $matches);
								$last_original_commit_id = array_get($matches, '1');

								if ( ! $last_original_commit_id && $name != 'menu')
								{
									$this->error("Not found git signature in $filename");
								}
								else
								{
									$this->line(" get last translated original commit $last_original_commit_id");
									$original_commit = $this->githubOriginal->getCommit($last_original_commit_id);
									$count_ahead = 0;
									$current_original_commit = "";
									if ($original_commit)
									{
										$last_original_commit_at = Carbon::createFromTimestampUTC(strtotime($original_commit['commit']['committer']['date']));

										// Считаем сколько коммитов прошло с момента перевода
										$this->line(" get current original commit");
										$original_commits = $this->githubOriginal->getCommits($version, $filename, $last_original_commit_at);
										$count_ahead = count($original_commits) - 1;
										$current_original_commit = $this->githubOriginal->getLastCommit($version, $filename);
										$current_original_commit_id = $current_original_commit['sha'];
										$current_original_commit_at = Carbon::createFromTimestampUTC(
											strtotime(
												$current_original_commit['commit']['committer']['date']
											)
										);

									}
									else
									{
										$last_original_commit_at = null;
									}

									$content = preg_replace("/git(.*?)(\n*?)---(\n*?)/", "", $content);
									preg_match("/#(.*?)$/m", $content, $matches);
									$title = trim(array_get($matches, '1'));
									$page = Document::version($v)->name($name)->first();
									if ($page)
									{
										if ($last_commit_id != $page->last_commit)
										{
											$page->last_commit = $last_commit_id;
											$page->last_commit_at = $last_commit_at;
											$page->last_original_commit = $last_original_commit_id;
											$page->last_original_commit_at = $last_original_commit_at;
											$page->current_original_commit = $current_original_commit_id;
											$page->current_original_commit_at = $current_original_commit_at;
											$page->original_commits_ahead = $count_ahead;
											$page->title = $title;
											$page->text = $content;
											$page->save();
											$this->info("$version/$filename updated. Commit $last_commit_id. Last original commit $last_original_commit_id.");
										}
									}
									else
									{
										Document::create([
											'version_id' => $id,
											'name' => $name,
											'title' => $title,
											'last_commit' => $last_commit_id,
											'last_commit_at' => $last_commit_at,
											'last_original_commit' => $last_original_commit_id,
											'last_original_commit_at' => $last_original_commit_at,
											'current_original_commit' => $current_original_commit_id,
											'current_original_commit_at' => $current_original_commit_at,
											'original_commits_ahead' => $count_ahead,
											'text' => $content
										]);

										$this->info("Translate for $version/$filename created, commit $last_commit_id. Translated from original commit $last_original_commit_id.");
									}
								}
							}
						}
					}
				}
				catch (RuntimeException $e)
				{
					Log::error('su:update_docs \Github\Exception\RuntimeException ' . $e->getMessage());
					die();
				}
			}
		}

		Log::info('su:update_docs   end');
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
			['branch', null, InputOption::VALUE_OPTIONAL, 'Branch for update.', null],
			['file', null, InputOption::VALUE_OPTIONAL, 'File for update.', null],
		];
	}

	/**
	 * When a command should run
	 *
	 * @param Schedulable|Scheduler $scheduler
	 *
	 * @return \Indatus\Dispatcher\Scheduling\Schedulable
	 */
	public function schedule(Schedulable $scheduler)
	{
		return $scheduler->everyHours(1)->minutes(8);
	}

}
