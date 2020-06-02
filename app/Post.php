<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $fillable = ['title','content','place'] ;

    public function todos(){
        return $this->hasMany('App\Todo');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function comments(){
        return $this->hasMany('App\Comment');
    }

    public function joins(){
        return $this->hasMany('App\Join');
    }
}