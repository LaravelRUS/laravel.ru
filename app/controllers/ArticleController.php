<?php 

use Carbon\Carbon;
use LaravelRU\Article\Access\ArticleAccess;
use Laracasts\Validation\FormValidationException;
use LaravelRU\Article\Forms\CreateArticleForm;
use LaravelRU\Article\Forms\UpdateArticleForm;
use LaravelRU\Article\Repositories\ArticleRepo;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ArticleController extends BaseController {

	/**
	 * @var ArticleAccess
	 */
	private $access;
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

	public function __construct(ArticleAccess $access, CreateArticleForm $createArticleForm, UpdateArticleForm $updateArticleForm, ArticleRepo $articleRepo)
	{
		$this->access = $access;
		$this->articleRepo = $articleRepo;
		$this->createArticleForm = $createArticleForm;
		$this->updateArticleForm = $updateArticleForm;
	}

	public function show($slug)
	{
		$article = $this->articleRepo->getBySlug($slug);
		if( ! $article) throw new NotFoundHttpException;

		$author = $article->author;

		return View::make("article/view_article", compact("article"));
	}

	public function create()
	{
		$article = $this->articleRepo->create(['is_draft'=>'1']);
		return View::make("article/edit_article", compact("article"));
	}

	public function edit($slug)
	{
		$this->access->checkEditArticleBySlug($slug);

		$article = $this->articleRepo->getBySlug($slug);
		if( ! $article) throw new NotFoundHttpException;

		return View::make("article/edit_article", compact("article"));
	}

	public function store()
	{
		$article_id = Input::get("id");
		$input = Input::all();

		if( $article_id ){
			$this->access->checkEditArticle($article_id);
			$article = $this->articleRepo->find($article_id);
			$this->updateArticleForm->validate($input);
		}else{
			$article = $this->articleRepo->create();
			$article->author_id = \Auth::id();
			$this->createArticleForm->validate($input);
		}

		$article->fill($input);

		if($article->is_draft == 0 AND is_null($article->published_at)) $article->published_at = Carbon::now();
		$article->save();

		return Redirect::route("article.edit", [$article->slug])->with("success", "Пост сохранен - <a href='".route("article.view",[$article->slug])."'>".route("article.view",[$article->slug])."</a>");
	}

}