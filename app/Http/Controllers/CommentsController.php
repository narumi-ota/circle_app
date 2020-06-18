<?php

namespace App\Http\Controllers;
use App\Post;
use App\Comment;
use App\User;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function store(Request $request,Post $post){
        $comment = new Comment();
        $comment->content = $request->content;
        $comment->user_id = $request->user()->id;
        $comment->post_id = $post->id;
        $comment->save();
        return view('posts.show')->with('post',$post);
    }

    public function show(Post $post){
        $comments = Comment::where('post_id', $post->id)
            ->get();
        return view('comments.show')->with('comments',$comments);
    }

    public function destroy(Comment $comment, Request $request){
         $comment->delete();
         return redirect()->back();   
    }
}