@extends('layouts.app')

@section('title','Posts')

@section('content')

<a href="{{ url('/posts/create') }}" class="new_post">新しいサークルを立ち上げる</a>

    <div class="search">
        <p>サークル名もしくは開催場所で検索</p>
    	  {{ Form::open(['method' => 'GET']) }}
    	  {{ Form::input('検索する', 'q', null) }}
          {{ Form::submit('検索') }}
    	  {{ Form::close() }}
    </div>

    <ul class="clearfix">
        @forelse ($posts as $post)
        <li>
            <div class="post_card">
                <div class="post_card_header">
                    {{ mb_strimwidth($post->title, 0, 24, "...") }}
                </div>
                <div class="post_card_textbox">
                    <div class="user_icon">
                    <img src="{{ $post->user->image_path }}" width="100px" height="100px" alt="user_icon">
                    </div>
                    <p>主催者： 
                        <a href="{{ action('UsersController@show',$post->user) }}">{{    $post->user->name }}  </a>
                    </p>
                    <p>開催場所：{{ mb_strimwidth($post->place, 0, 20, "...") }}</p>
                    <p>活動内容：{{ mb_strimwidth($post->content, 0, 50, "...") }}</p>
                    <a href="{{ action('PostsController@show',$post) }}">詳しくみる</a>
                </div>
            </div>
        </li>
        @empty
        <ll>サークルはまだありません</li>
        @endforelse
    </ul>

    <div class="d-flex justify-content-center mb-5">
      {{ $posts->links() }}
    </div>

@endsection