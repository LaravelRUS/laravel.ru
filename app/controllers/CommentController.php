<?php

use LaravelRU\Comment\Models\Comment;
use LaravelRU\Comment\CommentRepo;
use LaravelRU\Comment\Access\CommentAccess;
use LaravelRU\Comment\Forms\CreateCommentForm;
use LaravelRU\Comment\Forms\UpdateCommentForm;

class CommentController extends BaseController{


	/**
	 * @var PostAccess
	 */
	private $access;

	/**
	 * @var PostRepo
	 */
	private $commentRepo;

	/**
	 * @var CreatePostForm
	 */
	private $createCommentForm;

	/**
	 * @var UpdateCommentForm
	 */
	private $updateCommentForm;


	public function __construct(CommentAccess $access, CreateCommentForm $createCommentForm, UpdateCommentForm $updateCommentForm, CommentRepo $commentRepo)
	{
		$this->access = $access;
		$this->commentRepo = $commentRepo;
		$this->createCommentForm = $createCommentForm;
		$this->updateCommentForm = $updateCommentForm;
	}


	public function store()
	{

		if(Input::has('id'))
		{
			$comment = Comment::find(Input::get('id'));
			$comment->text = Input::get('text');

			$this->commentRepo->storeComment($comment);

			return Response::json(['success'=>true]);
		}

		$input = Input::except('_token', 'commentable_type'. 'commentable_id');

		$this->createCommentForm->validate($input);

		$comment = new Comment($input);

		$this->commentRepo->storeComment($comment, Input::get('commentable_type'), Input::get('commentable_id'));

		return Response::json(['success'=>true]);

	}

	public function delete()
	{
		Comment::whereId(Input::get('id'))->delete();

		return Response::json(['success'=>true]);

	}

}