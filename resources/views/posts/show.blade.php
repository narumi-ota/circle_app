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

          <div class="col-4">
            @if ($todo->status == '完了済み')
              <form action="{{ route('todo.destroy', $todo->id) }}" method="post">
                <input type="hidden" name="room_id" value="{{$todo->post_id}}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">削除する</button>
              </form>
            @else
              <form action="{{ route('todo.change', $todo->id) }}" method="get">
                @csrf
                <input type="hidden" name="post_id" value="{{$todo->post_id}}">
                <button type="submit" class="btn btn-info btn-sm">ステータス更新</button>
              </form>
            @endif
          </div>

      {{ $todo->due_date }}
      {{ $todo->updated_at->format('Y-m-d') }}
      </form>
    </li>
    @empty
    <ll>No Todos yet</li>
    @endforelse
  </ul>

  <h3>Todoを追加する</h3>
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

  <h2>Comment</h2>
  <ul>
    @forelse ($post->comments as $comment)
    <li>
      {{ $comment->content }}
      {{ $comment->created_at->format('Y-m-d') }}
    </li>
    @empty
    <ll>No Comments yet</li>
    @endforelse
  </ul>

  <h3>コメントを追加する</h3>
  <form method="post" action="{{ action('CommentsController@store', $post) }}">
    {{ csrf_field() }}
    <p>
      <input type="text" name="content" placeholder="enter comment" value="{{ old('content') }}">
      @if ($errors->has('content'))
      <span class="error">{{ $errors->first('content') }}</span>
      @endif
    </p>

    <p>
      <input type="submit" value="Add Comment">
    </p>
  </form>
<script src="/js/main.js"></script>
@endsection