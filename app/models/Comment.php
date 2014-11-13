<?php

use Carbon\Carbon;

class Comment extends \Eloquent {
    protected $table = "comments";
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo("User");
    }

    public function commentable()
    {
        return $this->morphTo();
    }

}