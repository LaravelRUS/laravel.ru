<?php 

use Carbon\Carbon;
use LaravelRU\Post\Access\PostAccess;
use Laracasts\Validation\FormValidationException;
use LaravelRU\Post\Forms\CreatePostForm;
use LaravelRU\Post\Forms\UpdatePostForm;
use LaravelRU\Post\Repositories\PostRepo;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
		if( ! $post) throw new NotFoundHttpException;

		$author = $post->author;
		$str = $author->present()->name;

		return View::make("post/view_post", compact("post"));
	}

	public function create()
	{
		$post = $this->postRepo->create(['is_draft'=>'1']);
		return View::make("post/edit_post", compact("post"));
	}

	public function edit($slug)
	{
		$this->access->checkEditPostBySlug($slug);

		$post = $this->postRepo->getBySlug($slug);
		if( ! $post) throw new NotFoundHttpException;

		return View::make("post/edit_post", compact("post"));
	}

	public function store()
	{
		$post_id = Input::get("id");
		$input = Input::all();

		if( $post_id ){
			$this->access->checkEditPost($post_id);
			$post = $this->postRepo->find($post_id);
			$this->updatePostForm->validate($input);
		}else{
			$post = $this->postRepo->create();
			$post->author_id = \Auth::id();
			$this->createPostForm->validate($input);
		}

		$post->fill($input);

		if($post->is_draft == 0 AND is_null($post->published_at)) $post->published_at = Carbon::now();
		$post->save();

		return Redirect::route("post.edit", [$post->slug])->with("success", "Пост сохранен - <a href='".route("post.view",[$post->slug])."'>".route("post.view",[$post->slug])."</a>");
	}

}