<?php

use Carbon\Carbon;
use LaravelRU\Access\Access;
use LaravelRU\Articles\Forms\CreateArticleForm;
use LaravelRU\Articles\Forms\UpdateArticleForm;
use LaravelRU\Articles\ArticleRepo;
use LaravelRU\Comment\Models\Comment;

class ArticlesController extends BaseController {

	/**
	 * @var ArticleRepo
	 */
	private $articleRepo;

	/**
	 * @var CreateArticleForm
	 */
	private $createArticleForm;

	/**
	 * @var UpdateArticleForm
	 */
	private $updateArticleForm;

	/**
	 * @var Access
	 */
	private $access;

	public function __construct(CreateArticleForm $createArticleForm, UpdateArticleForm $updateArticleForm, ArticleRepo $articleRepo, Access $access)
	{
		$this->articleRepo = $articleRepo;
		//$this->$createArticleForm = $createArticleForm;
		//$this->$updateArticleForm = $updateArticleForm;
		$this->access = $access;
	}

	public function showAll()
	{
		$articles = $this->articleRepo->getArticlesAndPaginate();

		return View::make('articles.show-all', compact('articles'));
	}

	public function show($slug)
	{
		$article = $this->articleRepo->getBySlug($slug);

		//TODO нужен рефакторинг /Greabock 18.01.15
		$article->load('comments', 'comments.author');

		$comments = $article->comments;

		$commentable_id = $article->id;

		$commentable_type = get_class($article);

		return View::make('articles.show', compact('article', 'comments', 'commentable_id', 'commentable_type'));
	}

	public function create()
	{
		if ( ! $article = $this->articleRepo->getUncompletedArticleByAuthor(Auth::user()))
		{
			$article = $this->articleRepo->create(['is_draft' => 1]);
			$article->author_id = Auth::id();
			$article->save();
		}

		return Redirect::route('articles.edit', $article->id);
	}

	public function edit($id)
	{
		$this->access->checkEditArticle($id);

		$post = $this->postRepo->findOrFail($id);

		return View::make('posts.edit-post', compact('post'));
	}

	public function store()
	{
		$post_id = Input::get('id');
		$input = Input::all();

		if ($post_id)
		{
			$this->access->checkEditArticle($post_id);
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