<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Join;

class JoinsController extends Controller
{
    public function change(Join $join, Request $request){
        
        if($join->status == 1) {
          $join->status = 0;
        }elseif ($join->status == 0) {
          $join->status = 1;
        }
        $join->user_id = $request->user()->id;
        $join->post_id = $post->id;
        $join->save();
  
        return redirect()->action('PostsController@show', ['id' => $request->post_id]);
      }
}