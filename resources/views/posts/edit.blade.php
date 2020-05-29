@extends('layouts.app')

@section('title','Edit Post')

@section('content')
  <h1>
  <a href="{{ url('/posts') }}" class="header-menu">Back</a>
  Edit Post</h1>
  <form method="post" action="{{ url('/posts', $post->id) }}">
  {{ csrf_field() }}
  {{ method_field('patch') }}
  <p>
    <input type="text" name="title" placeholder="enter title" value="{{ old('title',$post->title) }}">
    @if ($errors->has('title'))
    <span class="error">{{ $errors->first('title') }}</span>
    @endif
  </p>
  <p>
    <textarea name="content" placeholder="enter body">{{ old('content', $post->content) }}</textarea>
    @if ($errors->has('content'))
    <span class="error">{{ $errors->first('content') }}</span>
    @endif
  </p>
  <p>
    <input type="submit" value="Update">
  </p>
@endsection