@extends('layouts.app')

@section('title',"{{ $user->name }}")

@section('content')

<p>{{ $user->name }}</p>

<ul>
  @forelse ($posts as $post)
  <li>
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