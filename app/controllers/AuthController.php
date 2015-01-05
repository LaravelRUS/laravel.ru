<?php 

use LaravelRU\User\Forms\LoginForm;
use LaravelRU\User\Forms\RegistrationForm;

class AuthController extends BaseController {

	/**
	 * @var RegistrationForm
	 */
	private $registrationForm;
	/**
	 * @var LoginForm
	 */
	private $loginForm;

	public function __construct(RegistrationForm $registrationForm, LoginForm $loginForm)
	{
		$this->registrationForm = $registrationForm;
		$this->loginForm = $loginForm;
	}

	public function getRegistration()
	{
		$jsToken = Str::quickRandom(10);
		Session::set("jsToken", $jsToken);
		return View::make("auth/registration", compact("jsToken"));
	}
	public function postRegistration()
	{
		$input = Input::only('name', 'email', 'password', 'i_agree', 'g-recaptcha-response', 'js_token');

		$this->registrationForm->validate($input);

		unset($input['i_agree']);
		unset($input['js_token']);
		unset($input['g-recaptcha-response']);

		$user = User::create($input);
		$user->save();

		$confirmationString = Str::quickRandom(20);
		$userConfirmation = UserConfirmation::create(['code'=>$confirmationString]);

		$user->confirmation()->save($userConfirmation);

		$email = $input['email']; $password = $input['password'];
		Mail::queue("emails/auth/register", ['confirmationString' => $confirmationString], function($message)use($email){
			$message->from("postmaster@sharedstation.net");
			$message->to($email);
			$message->subject("Подтверждение регистрации");
		});

		//Auth::login($user);

		return Redirect::route("auth.registration.preconfirmation");
		//return Redirect::route("home");

	}

	public function getPreconfirmation()
	{
		return View::make("auth/preconfirmation");
	}

	public function getConfirmation($code)
	{
		$userConfirmation = UserConfirmation::where('code', $code)->first();
		if($userConfirmation){
			$user = $userConfirmation->user;
			$user->is_confirmed = 1;
			$user->save();
			$userConfirmation->delete();
			Auth::login($user);
			return View::make("auth/confirmation_success");
		}else{
			return View::make("auth/confirmation_error");
		}
	}

	public function getLogin()
	{
		return View::make("auth/login");
	}
	public function postLogin()
	{
		$input = Input::only("email", "password", "remember_me");
		$this->loginForm->validate($input);

		$success = Auth::attempt(['email'=>$input['email'], 'password'=>$input['password']], (bool)$input['remember_me'], true);

		if(!$success) {
			return Redirect::route("auth.login")->withErrors(['wrong_password'=>"Неправильный пароль."]);
		}

		return Redirect::intended();

	}

	public function getLogout()
	{
		Auth::logout();
		return Redirect::to("/");
	}


}