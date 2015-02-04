<?php

use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class HookController extends BaseController {

	protected $secret;

	public function __construct()
	{
		$this->secret = getenv('github_hook_secret');
	}

	public function checkAccess()
	{
		$githubSecretHash = Request::header('X-Hub-Signature');
		$body = file_get_contents('php://input');
		$calculatedSecretHash = 'sha1=' . hash_hmac('sha1', $body, $this->secret);
		if ($githubSecretHash !== $calculatedSecretHash)
		{
			throw new AccessDeniedException;
		}
	}

	public function docsIsUpdated()
	{
		$this->checkAccess();

		Queue::push(function ($job)
		{
			Log::info('GITHUB HOOK docs INCOMING');
			Artisan::call('su:update_docs');

			$job->delete();
		});

		return Response::json(['status' => 'success']);
	}

	public function pushToDevelop()
	{
		$this->checkAccess();

		Queue::push(function ($job)
		{
			Log::info('GITHUB HOOK push develop INCOMING');

			Log::info('Part1: reset repository to HEAD and pull changes');
			$arrayOutput = [];
			exec("cd /home/forge/sharedstation.net && git checkout develop && git reset HEAD --hard && git pull origin develop", $arrayOutput);
			foreach ($arrayOutput as $line)
			{
				Log::info(trim($line));
			}

			Log::info('Part2: composer update');
			$arrayOutput = [];
			exec("cd /home/forge/sharedstation.net && composer update", $arrayOutput);
			foreach ($arrayOutput as $line)
			{
				Log::info(trim($line));
			}

			Log::info('Part3: migration');
			$arrayOutput = [];
			exec("cd /home/forge/sharedstation.net && php artisan migrate", $arrayOutput);
			foreach ($arrayOutput as $line)
			{
				Log::info(trim($line));
			}

			$job->delete();
		});

		return Response::json(['status' => 'success']);
	}

}
