<?php

use LaravelRU\Post\PostRepo;
use LaravelRU\Tips\TipsRepo;
use LaravelRU\User\Models\User;
use LaravelRU\User\Repositories\UserRepo;

class UserController extends BaseController {

	/**
	 * @var UserRepo
	 */
	private $userRepo;

	/**
	 * @var PostRepo
	 */
	private $postRepo;

	/**
	 * @var TipsRepo
	 */
	private $tipsRepo;

	public function __construct(UserRepo $userRepo, PostRepo $postRepo, TipsRepo $tipsRepo)
	{
		$this->userRepo = $userRepo;
		$this->postRepo = $postRepo;
		$this->tipsRepo = $tipsRepo;
	}

	public function profile($username)
	{
		if ( ! $user = $this->userRepo->getByUsername($username)) abort();

		$user->load(['posts', 'tips', 'news', 'info', 'social']);

		// TODO для чего переменная $sidebar?
		//$sidebar = Sidebar::renderLastPosts();

		return View::make('user/profile', compact('user'));
	}

	public function edit()
	{
		$user = Auth::user();
		$user->load(['info', 'social']);

		return View::make('user/edit', compact('user'));
	}

	public function saveMain()
	{
		$data = Input::all();
		$response = app('app.response');

		$rules = [
			'username' => 'required|alphaDash|unique:users,username,' . Auth::id(),
			'email' => 'required|email|unique:users,email,' . Auth::id(),
			'fullname' => '',
		];

		$validator = Validator::make($data, $rules);

		if ( ! $validator->passes())
		{
			return $response->error('Исправьте ошибки в форме')->errors($validator->errors());
		}

		/** @var User $user */
		$user = Auth::user();

		$user->username = array_get($data, 'username');
		$user->email= array_get($data, 'email');
		$user->fullname = array_get($data, 'fullname');
		$user->save();

		return $response->message('Данные успешно сохранены');
	}

	public function saveSocial()
	{
		$data = Input::all();
		$response = app('app.response');

		$rules = [
			'social_vkontakte' => 'alphaNumDashDot',
			'social_facebook' => 'alphaNumDashDot',
			'social_twitter' => 'alphaNumDashDot',
			'social_github' => 'alphaNumDashDot',
			'social_bitbucket' => 'alphaNumDashDot',
			'social_google' => 'alphaNumDashDot',
		];

		$validator = Validator::make($data, $rules);

		if ( ! $validator->passes())
		{
			return $response->error('Исправьте ошибки в форме')->errors($validator->errors());
		}

		/** @var User $user */
		$user = Auth::user();

		$social = $user->social;
		$social->vkontakte = e(array_get($data, 'social_vkontakte'));
		$social->facebook = e(array_get($data, 'social_facebook'));
		$social->twitter = e(array_get($data, 'social_twitter'));
		$social->github = e(array_get($data, 'social_github'));
		$social->bitbucket = e(array_get($data, 'social_bitbucket'));
		$social->google = e(array_get($data, 'social_google'));

		$social->save();

		return $response->message('Данные успешно сохранены');
	}

	public function saveInfo()
	{
		$data = Input::all();
		$response = app('app.response');

		$rules = [
			'info_about' => '',
			'info_birthday' => 'date|date_format:Y-m-d',
			'info_site' => 'url',
			'info_skype' => 'alphaNumDashDot',
		];

		$validator = Validator::make($data, $rules);

		if ( ! $validator->passes())
		{
			return $response->error('Исправьте ошибки в форме')->errors($validator->errors());
		}

		/** @var User $user */
		$user = Auth::user();

		$info = $user->info;
		$info->about = e(strip_tags(array_get($data, 'info_about')));
		$info->birthday = array_get($data, 'info_birthday');
		$info->site = array_get($data, 'info_site');
		$info->skype = e(array_get($data, 'info_skype'));

		$info->save();

		return $response->message('Данные успешно сохранены');
	}

}
