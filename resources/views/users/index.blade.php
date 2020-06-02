@extends('layouts.app')

@section('title','Users')

@section('content')

<h1>Users</h1>
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

@endsection