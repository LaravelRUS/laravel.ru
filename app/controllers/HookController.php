<?php

class HookController extends BaseController {

	public function __construct()
	{
		$this->secret = 'nationstation385';
	}

	public function docsIsUpdated()
	{
		$githubSecretHash = Request::header('X-Hub-Signature');
		$body = file_get_contents('php://input');

		$calculatedSecretHash = 'sha1=' . hash_hmac('sha1', $body, $this->secret);

		if ($githubSecretHash === $calculatedSecretHash)
		{
			Queue::push(function ($job)
			{
				Log::info('GITHUB HOOK INCOMING');
				Artisan::call('su:update_docs');

				$job->delete();
			});

			return Response::json(['status' => 'success']);
		}
		else
		{
			Mail::send('emails/default', ['content' => "Wrong secret hash $calculatedSecretHash"], function ($message)
			{
				$message->from('robot@sharedstation.net');
				$message->to('slider23@gmail.com');
				$message->subject('SU:hook');
			});

			return Response::make('Wrong hash', 403);
		}
	}

}
