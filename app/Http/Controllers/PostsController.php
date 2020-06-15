<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use App\Todo;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Storage;
use Request as SearchRequest;

class PostsController extends Controller
{
    public function index(){
        $posts = Post::All()
            ->orderBy('created_at', 'desc')
            ->paginate(4);
        return view('posts.index')->with('posts',$posts);
    }

    public function show(Post $post){
        $comment =  Comment::where('post_id',$post->id)
            ->orderBy('created_at', 'desc')
            ->get();

        $todo =  Todo::where('post_id',$post->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('posts.show')->with([
            'post'=>$post, 
            'comment'=>$comment,
            'todo'=>$todo,
            ]);
    }

    public function create(){
        return view('posts.create');
    }

    public function store(PostRequest $request){
        $post = new Post();
        $post->title = $request->title;
        $post->place = $request->place;
        $post->content = $request->content;
        $post->longitude = $request->longitude;
        $post->latitude = $request->latitude;
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
        return redirect('/home');
    }

    public function destroy(Post $post){
        $post->delete();
        return redirect('/posts');
    }

    public function getSearch(){
        $query = SearchRequest::get('q');
    
        if ($query) {
            $posts = Post::where('title', 'LIKE', "%$query%")
            ->orWhere('place', 'LIKE', "%$query%")
            ->paginate(4);
        }else{
            $posts = Post::paginate(4);
        }
    
        return view('posts.index')->with('posts', $posts);
    }
}