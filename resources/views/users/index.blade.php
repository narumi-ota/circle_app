@extends('layouts.app')

@section('title','Users')

@section('content')

<h1>すべてのユーザー</h1>
    <table>
        <tbody>
        @foreach ($users as $user)
            <tr>
                <td>
                    <a href="{{ action('UsersController@show',$user) }}">
                    <img src="{{ $user->image_path }}" class="comment_user_icon" alt="user_icon">
                    <p>{{ $user->name }}</p>
                </td>
                <td>
                    <div class="speech_bubble_left">
                        <p>{{ $user->message }}</P>
                    </div>
                </td>
            <tr>
        @endforeach
        </tbody>
    </table>

@endsection