<?php namespace LaravelRU\Packages\Models;

use Laracasts\Presenter\PresentableTrait;
use LaravelRU\Likes\LikeableTrait;
use LaravelRU\Comment\CommentableTrait;
use LaravelRU\Comment\CommentableInterface;
use Illuminate\Database\Eloquent\Model;

class Package extends Model implements CommentableInterface{

	use CommentableTrait, LikeableTrait, PresentableTrait;

	protected $presenter = 'LaravelRU\Packages\Presenters\PackagePresenter';

}
