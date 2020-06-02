@extends('layouts.app')

@section('title','New Circle')

@section('content')

<a href="{{ url('/posts') }}" class="header-menu"><< 戻る</a>

<h1>新規立ち上げ</h1>
  
    <form method="post" action="{{ url('/posts') }}">
    {{ csrf_field() }}
  
    <p>
      <input type="text" name="title" placeholder="サークル名を入力してください" value="{{ old('title') }}">
      @if ($errors->has('title'))
      <span class="error">{{ $errors->first('title') }}</span>
      @endif
    </p>

    <p>
      <input type="text" name="place" placeholder="開催場所を入力してください" value="{{ old('place') }}">
      @if ($errors->has('place'))
      <span class="error">{{ $errors->first('place') }}</span>
      @endif
    </p>

    <p>
      <textarea name="content" placeholder="主な活動内容等を入力してください">{{ old('content') }}</textarea>
      @if ($errors->has('content'))
      <span class="error">{{ $errors->first('content') }}</span>
      @endif
    </p>
    
    <p>
      <input type="submit" value="この内容でサークルを立ち上げる">
    </p>

@endsection