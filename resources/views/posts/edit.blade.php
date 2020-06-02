@extends('layouts.app')

@section('title','Edit Post')

@section('content')

<a href="{{ url('/home') }}" class="header-menu"><< 戻る</a>

<h1>内容を編集</h1>
  
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
      <input type="text" name="place" placeholder="enter place" value="{{ old('place',$post->place) }}">
      @if ($errors->has('place'))
      <span class="error">{{ $errors->first('place') }}</span>
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