<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\HomeRequest;
use App\Http\Requests\MessageRequest;
use Illuminate\Support\Facades\Storage;
use App\Post;
use App\User;
use App\Join;

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
        
        $recent_post = Post::limit(2)
            ->orderBy('created_at', 'desc') 
            ->get();

        $joined = Join::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(3);
        
        return view('home')->with([
            'posts'=>$posts, 
            'user'=>$user,
            'recent_post'=>$recent_post,
            'joined' =>$joined,
            ]);
    }

    public function store(HomeRequest $request){
        $user = Auth::user();
        $image = $request->file('image');
        $path = Storage::disk('s3')->putFile('myprefix', $image, 'public');
        $user->image_path = Storage::disk('s3')->url($path);
        $user->save();
        return redirect()->back();
    }

    public function messageStore(MessageRequest $request){
        $user = Auth::user();
        $user->message = $request->message;
        $user->save();
        return redirect()->back();
    }
}