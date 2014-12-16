<?php 

class HookController extends BaseController {

	public function __construct()
	{
		$this->secret = "nationstation385";
	}

	public function docsIsUpdated()
	{
		$githubSecretHash = Request::header('X-Hub-Signature');
		$body = file_get_contents("php://input");

		$calculatedSecretHash = "sha1=".hash_hmac("sha1", $body, $this->secret);

		//if( $githubSecretHash === $calculatedSecretHash){
		if( 1 ){ // debug

			//Artisan::call("su:update_docs");
			Queue::push(function($job){

				Mail::send("emails/default", ['content'=>"su:update_docs begin"], function($message){
					$message->from("robot@sharedstation.net");
					$message->to("slider23@gmail.com");
					$message->subject("SU:hook");
				});

				Artisan::call("su:update_docs");

				Mail::send("emails/default", ['content'=>"su:update_docs end"], function($message){
					$message->from("robot@sharedstation.net");
					$message->to("slider23@gmail.com");
					$message->subject("SU:hook");
				});

				$job->delete();
			});



			return Response::json(['status'=>'success']);
		}else{
			Mail::send("emails/default", ['content'=>"Wrong secret hash $calculatedSecretHash"], function($message){
				$message->from("robot@sharedstation.net");
				$message->to("slider23@gmail.com");
				$message->subject("SU:hook");
			});
			return Response::make("Wrong hash", 403);
		}
	}
		
	
	
}