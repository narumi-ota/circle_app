@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">アクティビティ</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>自分の投稿</p>
                    @forelse ($posts as $post)
                    
                    <li>
                      <a href="{{ action('UsersController@show',$post->user) }}">{{ $post->user->name }}</a>
                      <a href="{{ action('PostsController@show',$post) }}">{{ $post->title }}</a>
                      <a href="{{ action('PostsController@edit',$post) }}">[Edit]</a>
                      <a href="#" data-id="{{ $post->id }}" class="del">[×]</a>
                      <form method="post" action="{{ url('/posts', $post->id ) }}" id="form_{{ $post->id }}">
                      {{ csrf_field() }}
                      {{ method_field('delete') }}
                    </li>
                    @empty
                    <ll>No Posts yet</li>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection