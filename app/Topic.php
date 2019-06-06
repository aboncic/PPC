<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    
    protected $fillable = [
        'title'
    ];

    public function posts()
    {
        return $this->hasMany('App\Post', 'topic_id', 'id');
    }

}
