<?php

use Illuminate\Http\Request;
use LaravelRU\Articles\ArticleRepo;
use LaravelRU\Core\Http\ValidatesRequests;
use LaravelRU\User\Forms\UpdateForm;
use LaravelRU\User\Models\User;
use LaravelRU\User\Repositories\UserRepo;

class UserController extends BaseController {

	use ValidatesRequests;

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

	/**
	 * @var Request
	 */
	private $request;

	public function __construct(UserRepo $userRepo,
	                            ArticleRepo $articleRepo,
	                            UpdateForm $updateForm,
	                            Request $request)
	{
		$this->userRepo = $userRepo;
		$this->articleRepo = $articleRepo;
		$this->updateForm = $updateForm;
		$this->request = $request;
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
		$data = $this->request->all();

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

	public function changeAvatar()
	{
		$this->validate($this->request, [
			'avatar' => 'required|image|max:1024'
		]);

		$user = Auth::user();
		$response = app('app.response');

		$path = public_path(avatar_path());

		$fileName = str_hash($user->id, 'avatar');
		$img = app('image')->make($this->request->file('avatar'))
			->fit(256, 256)
			->save("{$path}/{$fileName}.jpg");

		$user->info->avatar = $img;
		$user->info->save();

		return $response->message('Ваше фото успешно установленно')->data([
			'avatar' => $user->avatar
		]);
	}

	public function deleteAvatar()
	{
		$response = app('app.response');
		$user = Auth::user();

		$user->info->avatar = null;
		$user->info->save();

		return $response->message('Ваше фото удалено')->data([
			'avatar' => gravatar($user->email)
		]);
	}

}
