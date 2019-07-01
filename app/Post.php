<?php

namespace App;

use Overtrue\LaravelFollow\Traits\CanBeLiked;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	use CanBeLiked;

    protected $guarded = [];

    public function topic()
    {
        return $this->belongsTo('App\Topic');
    }

    public function user()
    {
    	return $this->belongsTo('App\User', 'posted_by', 'id');
    }

}
