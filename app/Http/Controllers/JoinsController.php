<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Join;
use App\Post;

class JoinsController extends Controller
{
    public function change(Request $request,Post $post){
        $user = Auth::user();
        $join = new Join();
        $join->user_id = $user->id;
        $join->post_id = $post->id;
        $join->save();
  
        return redirect()->back();
    }
    
    public function destroy(Request $request,Join $join){
        $join->delete();
        return redirect()->back();
    }
}