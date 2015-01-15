<?php

use Laracasts\Presenter\PresentableTrait;
use LaravelRU\Likes\LikeableTrait;
use LaravelRU\Comment\CommentableTrait;
use Illuminate\Database\Eloquent\Model;

class Package extends Model {

	use CommentableTrait, LikeableTrait, PresentableTrait;

	protected $presenter = 'LaravelRU\Packages\Presenters\PackagePresenter';

}
