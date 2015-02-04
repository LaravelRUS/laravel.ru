<?php

use Carbon\Carbon;
use LaravelRU\Access\Access;
use LaravelRU\Articles\Forms\CreateArticleForm;
use LaravelRU\Articles\Forms\UpdateArticleForm;
use LaravelRU\Articles\ArticleRepo;
use LaravelRU\Articles\Models\Article;
use LaravelRU\Articles\Models\DifficultyLevel;
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
		$this->createArticleForm = $createArticleForm;
		$this->updateArticleForm = $updateArticleForm;
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
		$user = Auth::user();
		$article = $user->articles()->draft()->first();
		$difficultyLevels = DifficultyLevel::lists('title', 'id');

		if ( ! $article)
		{
			$article = new Article();
			$article->author_id = Auth::id();
			$article->save();
		}

		return View::make('articles.create', compact('article', 'difficultyLevels', 'user'));
	}

	public function edit($id)
	{
		$this->access->checkEditArticle($id);

		$post = $this->postRepo->findOrFail($id);

		return View::make('posts.edit-post', compact('post'));
	}

	public function store()
	{
		$data = Input::all();

		$this->createArticleForm->validate($data);

		// TODO remove everything not needed in the text field

		$article = Article::find($data['id'])->first();

		$this->access->checkEditArticle($article);

		$article->fill($data);

		if ($article->is_draft == 0 && is_null($article->published_at))
		{
			$article->published_at = Carbon::now();
		}

		$article->save();

		return Redirect::route('user.profile')->with('success', 'Статья сохранена сохранен');
	}

}