<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\HomeRequest;
use Illuminate\Support\Facades\Storage;
use App\Post;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        $user = Auth::user();
        $posts = Post::where('user_id', $user->id) 
            ->orderBy('created_at', 'desc') 
            ->paginate(3); 
        return view('home')->with(['posts'=>$posts, 'user'=>$user]);
    }

    public function store(Request $request){
        $user = Auth::user();
        $image = $request->file('image');
        $path = Storage::disk('s3')->putFile('myprefix', $image, 'public');
        $user->image_path = Storage::disk('s3')->url($path);
        $user->save();
        return redirect('home')->with('success', '新しいプロフィールを登録しました');
    }
}