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

		$owner = $user->username == $username;

		// TODO для чего переменная $sidebar?
		//$sidebar = Sidebar::renderLastPosts();

		return View::make('user/profile', compact('user', 'owner'));
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

		if ( ! $user->save()) return $response->error('Ошибка');

		return $response->message('Данные успешно сохранены');
	}

	public function saveSocial()
	{
		$data = Input::all();
		$response = app('app.response');

		$rules = [
			'social_vkontakte' => 'social:vkontakte',
			'social_facebook' => 'social:facebook',
			'social_twitter' => 'social:twitter',
			'social_github' => 'social:github',
			'social_bitbucket' => 'social:bitbucket',
			'social_google' => 'social:google',
		];

		$validator = Validator::make($data, $rules);

		if ( ! $validator->passes())
		{
			return $response->error('Исправьте ошибки в форме')->errors($validator->errors());
		}

		/** @var User $user */
		$user = Auth::user();
		/** @var \LaravelRU\User\Models\UserSocialNetwork $social */
		$social = $user->social;

		$regexps = Config::get('social_regexp');
		foreach (trans('social') as $id => $name)
		{
			if ($value = trim(array_get($data, "social_{$id}")))
			{
				preg_match('/' . $regexps[$id] . '/u', $value, $matches);
				$value = $matches[2];
			}

			$social->{$id} = $value;
			$data["social_{$id}"] = $value;
		}

		if ( ! $social->save()) return $response->error('Ошибка');

		return $response->message('Данные успешно сохранены')->data(compact('data'));
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
		/** @var \LaravelRU\User\Models\UserInfo $info */
		$info = $user->info;

		$info->about = e(strip_tags(array_get($data, 'info_about')));
		$info->birthday = array_get($data, 'info_birthday');
		$info->site = array_get($data, 'info_site');
		$info->skype = array_get($data, 'info_skype');

		if ( ! $info->save())  return $response->error('Ошибка');

		return $response->message('Данные успешно сохранены');
	}

}
