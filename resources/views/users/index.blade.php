@extends('layouts.app')

@section('title','Users')

@section('content')
    <ul>
      @forelse ($users as $user)
      <li>
        <a>{{ $user->name }}</a>
        <a href="{{ action('UsersController@show',$user) }}">{{ $user->name }}</a>
      </li>
      @empty
      <ll>No Users yet</li>
      @endforelse
    </ul>
    <script src="/js/main.js"></script>
@endsection