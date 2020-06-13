@extends('layouts.app')

@section('content')

    <div class="post_card">
        <div class="post_card_header">{{ $user->name }} のプロフィール</div>
            <div class="post_card_textbox">
        
                @if ($user->image_path)
                <figure>
                    <img src="{{ $user->image_path }}" width="100px" height="100px">
                    <figcaption>現在のプロフィール画像</figcaption>
                </figure>
                @endif

                @if ($user->message)
                <p>{{ $user->message }}</p>
                @endif
               
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
                @endif

                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
                
                <p>▼プロフィールを更新</p>
                <form method="post" action="/home" enctype="multipart/form-data" >
                    {{ csrf_field() }}
                <input type="file" name="image">

                <input type="string" name="message" placeholder="ひとことメッセージ" value="{{ old('message') }}">

                <input type="submit">
                </form>

            </div>
        </div>
    </div>

    <div class="post_card">
        <div class="post_card_header">{{ $user->name }} のサークル</div>
            <div class="post_card_textbox">
            @forelse ($posts as $post)
            <ul>
                <li>
                  <a href="{{ action('PostsController@show',$post) }}">{{ $post->title }}</a>
                  <a href="{{ action('PostsController@edit',$post) }}">[内容を編集]</a>
                  <a href="#" data-id="{{ $post->id }}" class="del">[削除]</a>
                  <form method="post" action="{{ url('/posts', $post->id ) }}" id="form_{{ $post->id }}">
                  {{ csrf_field() }}
                  {{ method_field('delete') }}
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
@endsection