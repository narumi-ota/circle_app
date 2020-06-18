@extends('layouts.app')

@section('content')

    <div class="post_card">
        <div class="post_card_header">
            <div class="user_icon">
                <img src="{{ $user->image_path }}" width="100px" height="100px" alt="user_icon">
            </div>
        
            @if ($user->message)
            <div class="speech_bubble">
                <p>{{ $user->message }}</p>
            </div>
            @else
            <div class="speech_bubble">
                <p>ひとことメッセージを登録してみよう！</p>
            </div>
            @endif
        </div>

        <div class="post_card_textbox">
            <p>▼プロフィール画像を変更</p>
            <form method="post" action="/home" enctype="multipart/form-data">
                {{ csrf_field() }}
            <input type="file" name="image">
            <input type="submit" value="画像を変更"class="btn btn-info">
            </form>
            
            <form method="post" action="/home/message" >
                {{ csrf_field() }}
            <input type="string" name="message" placeholder="ひとことメッセージ(24文字以内)" class="form-control" 
            style="margin-top: 20px;" value="{{ old('message') }}">
            <p><input type="submit" value="ひとことを更新"class="btn btn-info"></p>
            </form>
            @if ($errors->has('message'))
                <span class="error">{{ $errors->first('message') }}</span>
            @endif
        </div>
    </div>

    <div class="post_card">
        <div class="post_card_header">{{ $user->name }} のサークル</div>
            <div class="post_card_textbox">
            <a href="{{ url('/posts/create') }}" class="btn btn-light">新しいサークルを立ち上げる</a>
                @forelse ($posts as $post)
                <ul>
                    <li>
                      <a href="{{ action('PostsController@show',$post) }}">{{ $post->title }}</a>
                      <a href="{{ action('PostsController@edit',$post) }}">[内容を編集]</a>
                      <a href="#" data-id="{{ $post->id }}" class="del">[削除]</a>
                      <form method="post" action="{{ route('post.destroy', $post->id ) }}" id="form_{{ $post->id }}">
                      {{ csrf_field() }}
                      {{ method_field('DELETE') }}
                      </form>
                    </li>
                </ul>
                @empty
                <ll>立ち上げたサークルはまだありません</li>
                @endforelse
                <div class="justify-content-center mb-5">
                    {{ $posts->links() }}
                </div>
        </div>
    </div>

    <div class="post_card">
        <div class="post_card_header">新着サークル</div>
            <div class="post_card_textbox">
            @foreach ($recent_post as $rpost)
            <ul>
                <li><a href="{{ action('PostsController@show',$rpost) }}">{{ $rpost->title}}</a>
                    <a href="{{ action('UsersController@show',$rpost->user) }}">
                    主催者:<img src="{{ $rpost->user->image_path }}" class="comment_user_icon" alt="user_icon">
                    </a>
                </li>
            </ul>
            @endforeach
            </div>
        </div>
    </div>
@endsection