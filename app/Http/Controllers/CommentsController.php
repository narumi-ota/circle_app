<?php

namespace App\Http\Controllers;
use App\Post;
use App\Comment;
use App\User;
use App\Http\Requests\CommentRequest;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function store(CommentRequest $request,Post $post){
        $comment = new Comment();
        $comment->content = $request->content;
        $comment->user_id = $request->user()->id;
        $comment->post_id = $post->id;
        $comment->save();
        return redirect()->back(); 
    }

    public function destroy(Comment $comment, Request $request){
         $comment->delete();
         return redirect()->back(); 
    }
}