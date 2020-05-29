<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    //
    protected $fillable = ['content', 'due_date', 'status'];

    public function post(){
        return $this->belongsTo('App\Post');
    }
}