@extends('layouts.app')

@section('title',"{{ $post->title }}")

@section('content')

<h1><a href="{{ url('/posts') }}" class="header-menu"><< 一覧へ戻る</a></h1>
  
    <div class="box">
        <span class="box-title">
        {{ $post->title }}
        </span>
    
        <p>活動内容：<br>{!! nl2br($post->content) !!}</p>
    </div>

    <div class="box">
        <p>開催場所：{{ $post->place }}</p>
        
        @if ($post->longitude)
        <p>地図：</p>
        <div id="target"></div>
        @endif
    </div>

    <div class="box">
        <span class="box-title">Todo</span>

        <form method="post" action="{{ route('todo.store', $post) }}">
            {{ csrf_field() }}
            <p>タスク
                <input type="text" name="content" placeholder="タスクを入力してください" value="{{ old('content') }}" style="width:300px;">
                @if ($errors->has('content'))
                <span class="error">{{ $errors->first('content') }}</span>
                @endif
            </p>

            <p>期日
                <input type="date" name="due_date" value="{{ old('due_date') }}">
                @if ($errors->has('due_date'))
                <span class="error">{{ $errors->first('due_date') }}</span>
                @endif

                <select name="status" value="{{ old('status') }}">
                    <option value="未着手">未着手</option>
                    <option value="進行中">進行中</option>
                    <option value="完了済み">完了済み</option>
                </select>

                <input type="submit" class="btn btn-info" value="Todoを追加">
            </p>
        </form>
        
        <table class="table">
            <thead>
                <tr>
                    <th>タスク</th>
                    <th>ステータス</th>
                    <th>期日</th>
                    <th>更新日</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($todo as $todo)
                <tr>
                    <th>{{ $todo->content }}</th>
                    <td>{{ $todo->status }}
                        @if ($todo->status == '完了済み')
                        <form method="post" action="{{ route('todo.destroy', $todo->id) }}">
                            <input type="hidden" name="status">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">削除する</button>
                        </form>
                        @else
                        <form  method="get" action="{{ route('todo.change', $todo->id) }}">
                            @csrf
                            <input type="hidden" name="status">
                            <button type="submit" class="btn btn-warning btn-sm">更新</button>
                        </form>
                        @endif
                    </td>
                    <td class="none">{{ $todo->due_date }}</td>
                    <td class="none">{{ $todo->updated_at->format('Y-m-d') }}</td>
                    @empty
                    <td>Todoはまだありません</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="participant_box">
        <span class="participant_box_title">参加者:{{ $join_count }}名</span>
  
        <form  method="get" action="{{ route('join.change', $post) }}">
            {{ csrf_field() }}
            <button type="submit" class="btn btn-warning">参加する</button>
        </form>

        @forelse ($join as $join) 
            <div class="participant_list">
                <a href="{{ action('UsersController@show',$join->user) }}">
                    <img src="{{ $join->user->image_path }}" class="comment_user_icon" alt="user_icon">
                </a>
                <br>
                {{ $join->user->name }}
                <br>
                @if( $join->user == Auth::user())
                <form  method="post" action="{{ route('join.destory', $join->id ) }}">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button type="submit" class="btn btn-light btn-sm">参加をやめる</button>
                </form>
                @endif
            </div>
        @empty
            <p>参加者はまだいません</p>
        @endforelse
    </div>


    <div class="box">
    <span class="box-title">コメント</span>

        <form method="post" action="{{ route('comment.store', $post) }}">
              {{ csrf_field() }}
              <p>
                  <input type="text" name="content" placeholder="コメントを入力してください" value="{{ old  ('content') }}"   style="width:300px;">
                  @if ($errors->has('content'))
                  <span class="error">{{ $errors->first('content') }}</span>
                  @endif
                  <input type="submit" class="btn btn-info" value="コメントを追加">
              </p>
        </form>
        <table class="table">
            <thead>
                <tr>
                    <th>コメント</th>
                    <th>投稿者</th>
                    <th>投稿日</th>
                </tr>
            </thead>

            <tbody>
            @forelse ($comment as $comment)
              <tr>
                    <th>{{ $comment->content }}</th>
                    <td>
                        <a href="{{ action('UsersController@show',$comment->user) }}">
                            <img src="{{ $comment->user->image_path }}" class="comment_user_icon" alt="user_icon">
                        </a>
                        <br>{{ $comment->user->name }}
                    </td>
                    <td>{{ $comment->created_at->format('Y-m-d') }}</td>
                    @if( $comment->user == Auth::user())
                    <td>
                        <form method="post" action="{{ route('comment.destroy',$comment->id) }}">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <input type="submit" value="削除" class="btn btn-light">
                        </form>
                    </td>
                    @endif
              </tr>
            @empty
            <td>コメントはまだありません</td>
            @endforelse
            </tbody>
        </table>
        
    </div>

    <script async defer
    src="https://maps.googleapis.com/maps/api/js?language=ja&
    reagion=JP&key={{ config('app.google_api') }}&callback=initMap">
    </script>
  
    <script>
      function initMap(){
      'use strict';
      var target = document.getElementById('target');
      var map;
      var spot = {lat: {{ $post->latitude }}, lng: {{ $post->longitude }}};
      var marker;
  
      map = new google.maps.Map(target,{
           center: spot,
           zoom: 18,
      });
       
      var marker = new google.maps.Marker({
            position: spot,
            map: map,
       });
      }
    </script>
@endsection