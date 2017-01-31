<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	// restricts columns from modifying
    protected $guarded = [];

    //get all comments for the post
    public function comments()
    {
    	return $this->hasMany('App\Comment','on_post');
    }

    //returns the author of post
    public function author()
    {
    	return $this->belongsTo('App\User','author_id');
    }
}
