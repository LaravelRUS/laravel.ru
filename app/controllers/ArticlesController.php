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
		$this->access->checkCreateArticle();

		$difficultyLevels = DifficultyLevel::lists('title', 'id');
		$isCreate = true;
		$article = new Article();

		return View::make('articles.edit', compact('article', 'difficultyLevels', 'isCreate'));
	}

	public function edit($id)
	{
		$article = $this->articleRepo->findOrFail($id);

		$this->access->checkEditArticle($article);

		$isCreate = false;

		return View::make('articles.edit', compact('article', 'isCreate'));
	}

	public function store()
	{
		$id = Input::get("id");
		$input = Input::all();
		if( $id )
		{
			// Редактируется существующая статья
			$this->access->checkEditArticle($id);
			$article = $this->articleRepo->find($id);
			$this->updateArticleForm->validate($input);
		}
		else
		{
			// Создается новая статья
			$article = $this->articleRepo->create();
			$article->author_id = \Auth::id();
			$this->createArticleForm->validate($input);
		}

		$article->fill($input);

		if ($article->is_draft == 0 && is_null($article->published_at))
		{
			$article->published_at = Carbon::now();
		}

		$article->save();

		return Redirect::route('articles.edit', [$article->id])->with('success', 'Статья сохранена.');
	}

}