@extends('layouts.app')

@section('title','Edit Todo')

@section('content')
  <h1>Edit Todo</h1>
  <p>
  <form method="post" action="{{ url('/todos', $todo->id) }}">
  {{ csrf_field() }}
  {{ method_field('patch') }}
  <p>
      <input type="text" name="content" placeholder="enter todo" value="{{ old('content', $todo->content) }}">
      @if ($errors->has('content'))
      <span class="error">{{ $errors->first('content') }}</span>
      @endif
    </p>

    <p>
      <input type="date" name="due_date" placeholder="enter due_date" value="{{ old('due_date', $todo->due_date) }}">
      @if ($errors->has('due_date'))
      <span class="error">{{ $errors->first('due_date') }}</span>
      @endif
    </p>

    <select name="status" placeholder="enter status" value="{{ old('status', $todo->status) }}">
      <option value=未着手>未着手</option>
      <option value=進行中>進行中</option>
      <option value=完了済み>完了済み</option>
    </select>

    <p>
      <input type="submit" value="Update Todo">
    </p>
</form>
@endsection