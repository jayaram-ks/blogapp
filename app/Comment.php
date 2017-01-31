<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //$guarded variable is used to prevent inserting/ updating some columns of the table. We want to use all columns so $guarded array is empty.
	protected $guarded = []; 
    //get the post details
    public function post()
    {
    	return $this->belongsTo('App\Post','on_post');
    }
    //get author of comment
    public function author()
    {
     	return $this->belongsTo('App\User','from_user');
    }
}
