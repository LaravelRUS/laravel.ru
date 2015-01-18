<?php namespace LaravelRU\News\Models;

use LaravelRU\Likes\LikeableTrait;
use LaravelRU\Comment\CommentableTrait;
use LaravelRU\Comment\CommentableInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingTrait;


class News extends Model implements CommentableInterface {

	use CommentableTrait, SoftDeletingTrait, LikeableTrait;

	protected $dates = ['deleted_at'];

	public function author()
	{
		return $this->belongsTo('LaravelRU\User\Models\User');
	}

	public function scopeApproved()
	{
		return $this->where('is_approved', 1);
	}

	public function scopeNotDraft()
	{
		return $this->where('is_draft', 0);
	}

}
