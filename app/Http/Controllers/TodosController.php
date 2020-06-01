<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Todo;

class TodosController extends Controller
{
    public function store(Request $request,Post $post){
        $this->validate($request,[
            'content' => 'required'
        ]);
        $todo = new Todo(['content'=> $request->content, 'due_date'=> $request->due_date, 'status'=> $request->status]);
        $post->todos()->save($todo);
        return redirect()-> action('PostsController@show', $post);
    }

    public function destroy(Todo $todo, Request $request){
        $todo->delete();
        return redirect()->back();
    }

    public function change(Todo $todo, Request $request){
      if($todo->status == '未着手') {
        $todo->status = '進行中';
      }elseif ($todo->status == '進行中') {
        $todo->status = '完了済み';
      }
      $todo->save();

      return redirect()->action('PostsController@show', ['id' => $request->post_id]);
    }
}