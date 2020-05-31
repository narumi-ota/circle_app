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

    public function destroy(Post $post, Todo $todo){
        $todo->delete();
        return redirect()->back();
    }

    public function showEditForm(int $id, int $todo_id){
        $task = Task::find($todo_id);

        return view('todos/edit', ['todo' => $todo,]);
    }
}