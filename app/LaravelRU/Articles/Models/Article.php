<?php namespace LaravelRU\Articles\Models;

use Eloquent;
use LaravelRU\Likes\LikeableTrait;
use LaravelRU\Comment\CommentableTrait;
use LaravelRU\Comment\CommentableInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Laracasts\Presenter\PresentableTrait;

class Article extends Eloquent implements CommentableInterface {

	use CommentableTrait, SoftDeletingTrait, LikeableTrait, PresentableTrait;

	const PUBLISHED_AT = 'published_at';

	protected $guarded = ['id', 'author_id'];

	protected $dates = ['deleted_at', self::PUBLISHED_AT];

	protected $presenter = 'LaravelRU\Articles\Presenters\ArticlePresenter';

	public function author()
	{
		return $this->belongsTo('LaravelRU\User\Models\User', 'author_id');
	}

	public function framework_version()
	{
		return $this->belongsTo('LaravelRU\Core\Models\Version');
	}

	public function difficulty_version()
	{
		return $this->belongsTo('LaravelRU\Articles\Models\DifficultyLevel');
	}

	public function scopeDraft($query)
	{
		return $query->where('is_draft', 1);
	}

	public function scopeNotDraft($query)
	{
		return $query->where('is_draft', 0);
	}

	public function scopeWithAuthor($query)
	{
		return $query->with('author');
	}

	public function scopeOrderByDatePublished($query, $sortOrder = 'desc')
	{
		return $query->orderBy(self::PUBLISHED_AT, $sortOrder);
	}
}
