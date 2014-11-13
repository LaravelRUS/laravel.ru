<?php

use LaravelRU\Access\Access;
use LaravelRU\News\Forms\CreateNewsForm;
use LaravelRU\News\Forms\UpdateNewsForm;

class NewsController extends BaseController {

	/**
	 * @var Access
	 */
	private $access;
	/**
	 * @var CreateNewsForm
	 */
	private $createNewsForm;
	/**
	 * @var UpdateNewsForm
	 */
	private $updateNewsForm;

	public function __construct(Access $access, CreateNewsForm $createNewsForm, UpdateNewsForm $updateNewsForm)
	{
		$this->access = $access;
		$this->createNewsForm = $createNewsForm;
		$this->updateNewsForm = $updateNewsForm;
	}

	public function create()
	{
		$news = new News();
		$news->is_draft = 1;
		$author = Auth::user();
		return View::make("news/edit_news", compact("news", "author"));
	}

	public function edit($id)
	{
		$news = News::find($id);
		if( ! $news) throw new NotFoundHttpException;
		$author = $news->user;

		return View::make("news/edit_news", compact("news", "author"));
	}

	public function store()
	{
		$news_id = Input::get("id");

		if( $news_id ){
			$this->updateNewsForm->validate(Input::all());
			$news = News::find($news_id);
			$this->access->checkEditNews($news);
		}else{
			$this->createNewsForm->validate(Input::all());
			$news = News::create([]);
			$news->author_id = Auth::id();
			$news->is_draft = 0;
			if(allowApproveNews()){
				$news->is_approved = 1;
			}else{
				$news->is_approved = 0;
			}
		}

		$news->text = Input::get("text");
		$news->save();

		if($news->is_approved){
			return Redirect::route("news.edit", [$news->id])->with("success", "Новость сохранена и опубликована.");
		}else{
			// TODO разослать уведомление модераторам на аппрув новости
			return Redirect::route("news.edit", [$news->id])->with("success", "Новость сохранена и будет опубликована после одобрения модераторами.");
		}

	}

	public function approve($id)
	{
		$this->access->checkApproveNews();


	}

	public function all()
	{
		$listNews = News::approved()->notDraft()->paginate(30);

		return View::make("news/list_news", compact("listNews"));
	}
	
}