<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Laracasts\Presenter\PresentableTrait; // https://github.com/laracasts/Presenter

/**
 * Post
 *
 * @property integer $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property \Carbon\Carbon $published_at
 * @property string $title
 * @property string $description
 * @property string $slug
 * @property string $category
 * @property integer $author_id
 * @property string $difficulty
 * @property boolean $is_draft
 * @property string $parser_type
 * @property string $text
 * @property string $translated_url
 * @property-read \User $author
 * @method static \Illuminate\Database\Query\Builder|\Post whereId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Post whereCreatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\Post whereUpdatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\Post whereDeletedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\Post wherePublishedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\Post whereTitle($value) 
 * @method static \Illuminate\Database\Query\Builder|\Post whereDescription($value) 
 * @method static \Illuminate\Database\Query\Builder|\Post whereSlug($value) 
 * @method static \Illuminate\Database\Query\Builder|\Post whereCategory($value) 
 * @method static \Illuminate\Database\Query\Builder|\Post whereAuthorId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Post whereDifficulty($value) 
 * @method static \Illuminate\Database\Query\Builder|\Post whereIsDraft($value) 
 * @method static \Illuminate\Database\Query\Builder|\Post whereParserType($value) 
 * @method static \Illuminate\Database\Query\Builder|\Post whereText($value) 
 * @method static \Illuminate\Database\Query\Builder|\Post whereTranslatedUrl($value) 
 * @method static \Post notDraft() 
 */
class Post extends \Eloquent {

	protected   $table =        'posts';
	protected   $primaryKey =   'id';
	public      $timestamps =   true;

	protected   $fillable =     [];
    protected   $guarded =      ['id','author_id'];
    protected   $hidden =       [];

	use         SoftDeletingTrait;
	protected   $dates =        ['deleted_at', 'published_at'];

	use         PresentableTrait;
	protected   $presenter =    'LaravelRU\Post\Presenters\PostPresenter';

	public static function boot()
	{
		parent::boot();
		// Setup event bindings...
	}

	public function author()
	{
		return $this->belongsTo('User', "author_id");
	}

	// ===== Scopes =====

	public function scopeNotDraft($query)
	{
		return $query->where("is_draft", 0);
	}


};