<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;

class UsersController extends Controller
{
    public function index(){
        $users = User::All();
        return view('users.index', ['users' => $users]);
    }

    public function show(User $user){
        $user = User::find($user->id); 
        $posts = Post::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('users.show', [
            'user' => $user,
            'posts' => $posts,
        ]);
    }
}