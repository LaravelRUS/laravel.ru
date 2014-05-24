<?php namespace SU\Docs\Commands;

use Github\Client;
use SU\Docs\Models\Docs;
use SU\Github\GithubRepo;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class UpdateDocsCommand extends Command {

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
	 * @var \SU\Github\GithubRepo
	 */
	private $githubTranslated;
	private $githubOriginal;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
		$this->githubTranslated =   new GithubRepo(\Config::get("laravel.translated_docs.user"), \Config::get("laravel.translated_docs.repository"));
		$this->githubOriginal =     new GithubRepo(\Config::get("laravel.original_docs.user"),   \Config::get("laravel.original_docs.repository"));
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$github = new Client();
		$http = new \Guzzle\Http\Client();

		$forceupdate = $this->argument("force");
		foreach(\Config::get("laravel.versions") as $version){

			if($forceupdate){
				Docs::version($version)->delete();
			}

			$content = $this->githubTranslated->getFile($version, "menu.md");
			$lines = explode("\n", $content);
			$lines[] = "[Menu](/docs/menu)";
			$matches = array();
			foreach($lines as $line){
				preg_match("/\(\/docs\/(.*?)\)/im", $line, $matches);
				if(isset($matches[1])){
					$name = $matches[1];
					$filename = $matches[1].".md";
					$last_commit = $this->githubTranslated->getLastCommitId($version, $filename);
					$content = $this->githubTranslated->getFile($version, $filename, $last_commit);
					if($content != null) {
						preg_match("/git (.*?)$/m", $content, $matches);
						$last_original_commit = array_get($matches, '1');
						if(!$last_original_commit AND $name!="menu") {
							$this->error("Not found git signature in $filename");
						}
						else {
							$content = preg_replace("/git(.*?)(\n*?)---(\n*?)/", "", $content);
							preg_match("/#(.*?)$/m", $content, $matches);
							$title = trim(array_get($matches, '1'));
							$page = Docs::version($version)->name($name)->first();
							if($page) {
								if($last_commit != $page->last_commit) {
									$page->last_commit = $last_commit;
									$page->last_original_commit = $last_original_commit;
									$page->title = $title;
									$page->text = $content;
									$page->save();
									$this->info("$filename updated. Commit $last_commit. Last original commit $last_original_commit.");
								}
							}
							else {
								Docs::create([
										'framework_version' => $version,
										'name' => $name,
										'title' => $title,
										'last_commit' => $last_commit,
										'last_original_commit' => $last_original_commit,
										'text' =>$content]);
								$this->info("$filename created. Commit $last_commit. Last original commit $last_original_commit.");
							}

						}
					}

				}
			}

		}
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
				array('force', InputArgument::OPTIONAL, 'Delete all docs and replace by github data.'),
		);
	}

}
