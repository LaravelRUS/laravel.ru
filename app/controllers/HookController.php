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

		$calculatedSecretHash = hash_hmac("sha1", $body, $this->secret);

		if( $githubSecretHash === "sha1=".$calculatedSecretHash){
			Mail::send("emails/admin/github_hook", [], function($message){
				$message->from("robot@sharedstation.net");
				$message->to("slider23@gmail.com");
				$message->subject("SU:hook");
			});
			Artisan::call("su:update_docs");
			return Response::json(['status'=>'success']);
		}else{
			return Response::make("Wrong secret hash", 403);
		}
	}
		
	
	
}