@extends('layouts.app')

@section('title','Users')

@section('content')

<h1>すべてのユーザー</h1>
    <table>
        <tbody>
        @foreach ($users as $user)
            <tr>
                <td class="user_icon">
                    <a href="{{ action('UsersController@show',$user) }}">
                    <img src="{{ $user->image_path }}" width="100px" height="100px" alt="user_icon">
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