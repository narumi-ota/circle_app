@extends('layouts.app')

@section('title','Posts')

@section('content')
    <h1>
    <a href="{{ url('/posts/create') }}" class="header-menu">New Post</a>
    Posts</h1>
    <ul>
      @forelse ($posts as $post)
      <li>
        <a href="{{ action('UsersController@show',$post->user) }}">{{ $post->user->name }}</a>
        <a href="{{ action('PostsController@show',$post) }}">{{ $post->title }}</a>
        <a href="{{ action('PostsController@edit',$post) }}">[Edit]</a>
        <a href="#" data-id="{{ $post->id }}" class="del">[×]</a>
        <form method="post" action="{{ url('/posts', $post->id ) }}" id="form_{{ $post->id }}">
        {{ csrf_field() }}
        {{ method_field('delete') }}
      </li>
      @empty
      <ll>No Posts yet</li>
      @endforelse
    </ul>
    <script src="/js/main.js"></script>
@endsection