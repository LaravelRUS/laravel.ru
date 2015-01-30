<?php

use Carbon\Carbon;
use LaravelRU\Post\Access\PostAccess;
use LaravelRU\Post\Forms\CreatePostForm;
use LaravelRU\Post\Forms\UpdatePostForm;
use LaravelRU\Post\PostRepo;
use LaravelRU\Comment\Models\Comment;

class PostController extends BaseController {

	/**
	 * @var PostAccess
	 */
	private $access;

	/**
	 * @var PostRepo
	 */
	private $postRepo;

	/**
	 * @var CreatePostForm
	 */
	private $createPostForm;

	/**
	 * @var UpdatePostForm
	 */
	private $updatePostForm;

	public function __construct(PostAccess $access, CreatePostForm $createPostForm, UpdatePostForm $updatePostForm, PostRepo $postRepo)
	{
		$this->access = $access;
		$this->postRepo = $postRepo;
		$this->createPostForm = $createPostForm;
		$this->updatePostForm = $updatePostForm;
	}

	public function show($slug)
	{
		$post = $this->postRepo->getBySlug($slug);
		if ( ! $post) App::abort(404);

		//Todo рефакторь меня полностью... Я тебя прошу! Ты можешь меня рефакторить? Зря... /Greabock 18.01.15
		$post->load('comments', 'comments.author');

		$comments = $post->comments;

		$commentable_id = $post->id;

		$commentable_type = get_class($post);

		return View::make('post/view_post', compact('post', 'comments', 'commentable_id', 'commentable_type'));
	}

	public function create()
	{
		if ( ! $post = $this->postRepo->getUncompletedPostByAuthor(Auth::user()))
		{
			$post = $this->postRepo->create(['is_draft' => 1]);
			$post->author_id = Auth::id();
			$post->save();
		}

		return Redirect::route('post.edit', $post->id);
	}

	public function edit($id)
	{
		$this->access->checkEditPost($id);

		if ( ! $post = $this->postRepo->find($id)) abort();

		return View::make('post/edit_post', compact('post'));
	}

	public function store()
	{
		$post_id = Input::get('id');
		$input = Input::all();

		if ($post_id)
		{
			$this->access->checkEditPost($post_id);
			$post = $this->postRepo->find($post_id);
			$this->updatePostForm->validate($input);
		}
		else
		{
			$post = $this->postRepo->create();
			$post->author_id = Auth::id();
			$this->createPostForm->validate($input);
		}

		$post->fill($input);

		if ($post->is_draft == 0 && is_null($post->published_at))
		{
			$post->published_at = Carbon::now();
		}

		$post->save();

		return Redirect::route('post.edit', $post->id)
			->with('success',
				'Пост сохранен - <a href="' . route('post.view', $post->slug) . '">'
				. route('post.view', $post->slug) . '</a>'
			);
	}

}
