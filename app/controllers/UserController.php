<?php

use LaravelRU\Post\PostRepo;
use LaravelRU\User\Forms\UpdateForm;
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
	 * @var UpdateForm
	 */
	private $updateForm;

	public function __construct(UserRepo $userRepo, PostRepo $postRepo, UpdateForm $updateForm)
	{
		$this->userRepo = $userRepo;
		$this->postRepo = $postRepo;
		$this->updateForm = $updateForm;
	}

	public function profile($username)
	{
		if ( ! $user = $this->userRepo->getByUsername($username)) abort();

		$user->load(['posts', 'tips', 'news', 'info', 'social']);

		$owner = Auth::check() && Auth::user()->username == $username;

		return View::make('user/profile', compact('user', 'owner'));
	}

	public function edit()
	{
		$user = Auth::user();
		$user->load(['info', 'social']);

		return View::make('user/edit', compact('user'));
	}

	public function update()
	{
		$response = app('app.response');
		$data = Input::all();

		$this->updateForm->validate($data);

		/** @var User $user */
		$user = Auth::user();

		$user->username = array_get($data, 'username');
		$user->email= array_get($data, 'email');
		$user->fullname = array_get($data, 'fullname');

		$regexps = Config::get('social_regexp');
		foreach (trans('social') as $id => $name)
		{
			if ($value = trim(array_get($data, "social_{$id}")))
			{
				preg_match('/' . $regexps[$id] . '/u', $value, $matches);
				$value = $matches[2];
			}

			$user->social->{$id} = $value;
			$data["social_{$id}"] = $value;
		}

		$data['info_about'] = e(strip_tags(array_get($data, 'info_about')));

		$user->info->about = $data['info_about'];
		$user->info->birthday = array_get($data, 'info_birthday');
		$user->info->site = array_get($data, 'info_site');
		$user->info->skype = array_get($data, 'info_skype');

		if ( ! $user->save() || ! $user->social->save() || ! $user->info->save())
		{
			return $response->error('Ошибка');
		}

		return $response->message('Данные успешно сохранены')->data([
			'redirect' => route('user.profile', $user->username)
		]);
	}

}
