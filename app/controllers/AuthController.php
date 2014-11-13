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
		return View::make("auth/registration");
	}
	public function postRegistration()
	{
		$input = Input::only('name', 'email', 'password', 'i_agree');

		$this->registrationForm->validate($input);

		unset($input['i_agree']);

		$user = User::create($input);
		$user->save();

		Auth::login($user);

		//return Redirect::route("auth.registration.confirmation");
		return Redirect::route("home");

	}
	public function getConfirmation()
	{
		return View::make("auth/confirmation");
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