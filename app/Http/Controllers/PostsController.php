<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Http\Requests\PostRequest;

class PostsController extends Controller
{
    public function index(){
        $posts = Post::latest()->get();
        // dd($posts->toArray());
        // $posts = [];
        return view('posts.index')->with('posts',$posts);
    }

    public function show(Post $post){
        // $post = Post::findOrFail($id);
        return view('posts.show')->with('post',$post);
    }

    public function create(){
        return view('posts.create');
    }

    public function store(PostRequest $request){
        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->content;
        $post->user_id = $request->user()->id;
        $post->save();
        return redirect('/posts');
    }

    public function edit(Post $post){
        return view('posts.edit')->with('post',$post);
    }

    public function update(PostRequest $request, Post $post){
        $post->title = $request->title;
        $post->content = $request->content;
        $post->save();
        return redirect('/posts');
    }

    public function destroy(Post $post){
        $post->delete();
        return redirect('/posts');
    }
}