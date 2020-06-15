<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TodoRequest;
use App\Post;
use App\Todo;

class TodosController extends Controller
{
    public function store(TodoRequest $request,Post $post){
        $todo = new Todo();
        $todo->content = $request->content;
        $todo->due_date = $request->due_date;
        $todo->status = $request->status;
        $todo->post_id = $post->id;
        $todo->save();
        return redirect()-> action('PostsController@show', $post);
    }

    public function destroy(Todo $todo, Request $request){
        $todo->delete();
        return redirect()->back();
    }

    public function change(Todo $todo, Request $request, Post $post){
      if($todo->status == '未着手') {
        $todo->status = '進行中';
      }elseif ($todo->status == '進行中') {
        $todo->status = '完了済み';
      }
      $todo->save();

      return redirect()->back();
    }
}