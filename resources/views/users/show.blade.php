@extends('layouts.app')

@section('title',"{{ $user->name }}")

@section('content')

<h1><a href="{{ url('/posts') }}" class="header-menu"><< サークル一覧へ戻る</a></h1>

<h1>{{ $user->name }}のサークル</h1>

<ul class="clearfix">
    @forelse ($posts as $post)
    <li>
        <div class="post_card">

            <div class="post_card_header">
              {{ $post->title }}
            </div>

            <div class="post_card_textbox">
              <div class="user_icon">
                <img src="{{ $post->user->image_path }}" width="100px" height="100px">
              </div>
              <p>主催者： {{ $post->user->name }}</p>
              <p>開催場所：{{ $post->place }}</p>
              <p>活動内容：{{ $post->content }}</p>
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