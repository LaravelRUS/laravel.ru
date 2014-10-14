<?php

/**
 * Docs
 *
 * @property integer $id
 * @property string $framework_version
 * @property string $name
 * @property string $last_commit
 * @property string $last_original_commit
 * @property string $title
 * @property string $text
 * @property integer $updater_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Docs whereId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Docs whereFrameworkVersion($value) 
 * @method static \Illuminate\Database\Query\Builder|\Docs whereName($value) 
 * @method static \Illuminate\Database\Query\Builder|\Docs whereLastCommit($value) 
 * @method static \Illuminate\Database\Query\Builder|\Docs whereLastOriginalCommit($value) 
 * @method static \Illuminate\Database\Query\Builder|\Docs whereTitle($value) 
 * @method static \Illuminate\Database\Query\Builder|\Docs whereText($value) 
 * @method static \Illuminate\Database\Query\Builder|\Docs whereUpdaterId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Docs whereCreatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\Docs whereUpdatedAt($value) 
 * @method static \Docs version($version) 
 * @method static \Docs name($name) 
 */
class Docs extends Eloquent {

	protected   $table =       'docs';
	protected   $primaryKey =  'id';
	public      $timestamps =  true;
	protected   $softDelete =  false;
	protected   $guarded =     [];
	protected   $hidden =      [];
	protected   $dates =       ['last_commit_at', 'last_original_commit_at'];


	public function scopeVersion($query, $version)
	{
		return $query->where('framework_version', '=', $version);
	}

	public function scopeName($query, $name)
	{
		return $query->where('name', '=', $name);
	}

	public function displayTitle()
	{
		return e($this->title);
	}

	public function displayText()
	{
		$parsedown = new Parsedown();
		$text = $this->text;
		$html = $parsedown->text($text);
		return $html;
	}
	
}