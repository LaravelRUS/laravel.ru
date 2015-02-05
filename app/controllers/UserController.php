<?php

use LaravelRU\Articles\ArticleRepo;
use LaravelRU\User\Forms\UpdateForm;
use LaravelRU\User\Models\User;
use LaravelRU\User\Repositories\UserRepo;

class UserController extends BaseController {

	/**
	 * @var UserRepo
	 */
	private $userRepo;

	/**
	 * @var ArticleRepo
	 */
	private $articleRepo;

	/**
	 * @var UpdateForm
	 */
	private $updateForm;

	public function __construct(UserRepo $userRepo, ArticleRepo $articleRepo, UpdateForm $updateForm)
	{
		$this->userRepo = $userRepo;
		$this->articleRepo = $articleRepo;
		$this->updateForm = $updateForm;
	}

	public function showAll()
	{
		return View::make('//TODO');
	}

	public function profile($username)
	{
		$user = User::username($username)->withLatestArticles(10)
			->withInfo()->withSocial()->firstOrFail();

		return View::make('user.profile', compact('user'));
	}

	public function edit()
	{
		$user = User::withInfo()->withSocial()->findOrFail(Auth::id());

		return View::make('user.settings', compact('user'));
	}

	public function update()
	{
		$response = app('app.response');
		$data = Input::all();

		$this->updateForm->validate($data);

		/** @var User $user */
		$user = Auth::user();
		$user->info->name = array_get($data, 'name');
		$user->info->surname = array_get($data, 'surname');
		$user->info->birthday = array_get($data, 'birthday');
		$user->info->about = e(strip_tags(array_get($data, 'about')));
		$user->info->website = array_get($data, 'website');
		$user->info->skype = array_get($data, 'skype');

		if ( ! $user->save() || ! $user->info->save())
		{
			return $response->error('Ошибка');
		}

		return $response->data([
			'title' => 'Данные успешно сохранены',
			'redirect' => route('user.profile', $user->username)
		]);
	}

}
