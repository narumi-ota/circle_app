@extends('layouts.app')

@section('title','New Post')

@section('content')
  <h1>
  <a href="{{ url('/posts') }}" class="header-menu">Back</a>
  New Post</h1>
  <form method="post" action="{{ url('/posts') }}">
  {{ csrf_field() }}
  <p>
    <input type="text" name="title" placeholder="enter title" value="{{ old('title') }}">
    @if ($errors->has('title'))
    <span class="error">{{ $errors->first('title') }}</span>
    @endif
  </p>
  <p>
    <textarea name="content" placeholder="enter body">{{ old('content') }}</textarea>
    @if ($errors->has('content'))
    <span class="error">{{ $errors->first('content') }}</span>
    @endif
  </p>
  <p>
    <input type="submit" value="Add">
  </p>
@endsection