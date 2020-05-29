@extends('layouts.app')

@section('title',"{{ $post->title }}")

@section('content')
  <h1>
  <a href="{{ url('/posts') }}" class="header-menu">Back</a>
  {{ $post->title }}</h1>
  <p>{!! nl2br($post->content) !!}</p>

  <h2>Todo</h2>
  <ul>
    @forelse ($post->todos as $todo)
    <li>
      {{ $todo->content }}
      {{ $todo->status }}
      {{ $todo->due_date }}
      {{ $todo->updated_at }}
      <a href="#" data-id="{{ $todo->id }}" class="del">[×]</a>
      <form method="post" action="{{ action('TodosController@destroy', [$post, $todo]) }}" id="form_{{ $todo->id }}">
      {{ csrf_field() }}
      {{ method_field('delete') }}
      </form>
    </li>
    @empty
    <ll>No Todos yet</li>
    @endforelse
  </ul>
  <form method="post" action="{{ action('TodosController@store', $post) }}">
    {{ csrf_field() }}
    <p>
      <input type="text" name="content" placeholder="enter todo" value="{{ old('content') }}">
      @if ($errors->has('content'))
      <span class="error">{{ $errors->first('content') }}</span>
      @endif
    </p>

    <p>
      <input type="date" name="due_date" placeholder="enter due_date" value="{{ old('due_date') }}">
      @if ($errors->has('due_date'))
      <span class="error">{{ $errors->first('due_date') }}</span>
      @endif
    </p>

    <select name="status" placeholder="enter status" value="{{ old('status') }}">
      <option value=未着手>未着手</option>
      <option value=進行中>進行中</option>
      <option value=完了済み>完了済み</option>
    </select>

    <p>
      <input type="submit" value="Add Todo">
    </p>
</form>
<script src="/js/main.js"></script>
@endsection