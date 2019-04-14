<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table    = 'posts';
    protected $fillable = [
        'title',
        'body',
        'image',

        'user_id',
    ];
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function likes()
    {
        return $this->hasMany('App\Like');
    }
    public function comments()

    {

        return $this->hasMany(Comment::class)->whereNull('parent_id');

    }
}
