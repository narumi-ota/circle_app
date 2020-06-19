@extends('layouts.app')

@section('title','Edit Post')

@section('content')

<a href="{{ url('/home') }}" class="header-menu"><< 戻る</a>

<h1>内容を編集</h1>
  
    <form method="post" action="{{ url('/posts', $post->id) }}">
    {{ csrf_field() }}
    {{ method_field('patch') }}

    <p>
      <input type="submit" value="更新" class="btn btn-info">
    </p>

    <p>サークル名：</p>
      <input type="text" name="title" placeholder="サークル名を入力してください" value="{{ old('title',$post->title) }}">
      @if ($errors->has('title'))
      <span class="error">{{ $errors->first('title') }}</span>
      @endif

    <p>活動内容：</p>
      <textarea name="content" placeholder="主な活動内容等を入力してください">{{ old('content',$post->content) }}</textarea>
      @if ($errors->has('content'))
      <span class="error">{{ $errors->first('content') }}</span>
      @endif

    <p>開催場所：</p>
      <input type="text" name="place" placeholder="開催場所を入力してください" value="{{ old('place',$post->place) }}">
      @if ($errors->has('place'))
      <span class="error">{{ $errors->first('place') }}</span>
      @endif
    
    <input type="hidden" name="longitude" value="{{ old('longitude',$post->longitude) }}" id="lng">
    <input type="hidden" name="latitude" value="{{ old('latitude',$post->latitude) }}" id="lat">

    <p>集合場所の位置情報を追加する場合：<br>場所名で検索してピンを合わせてね</p>
    <form onsubmit="return false;" >
      <input type="text", id="address">
      <button type="button" id="map_button">検索</button>
    </form>
    <div class="map_box01"><div id="map-canvas" style="width: 400px; height: 250px;"></div></div>

    <script async defer
      src="https://maps.googleapis.com/maps/api/js?language=ja&
      reagion=JP&key={{ config('app.google_api') }}&callback=initMap">
    </script>

    <script>
      function initMap(){
      'use strict';

      var getMap = (function() {
      function codeAddress(address) {
      var geocoder = new google.maps.Geocoder();
      
      var mapOptions = {
        zoom: 16,
        mapTypeId: google.maps.MapTypeId.ROADMAP
      };
    
      var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
      var marker;

      geocoder.geocode( { 'address': address}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
          map.setCenter(results[0].geometry.location);
          document.getElementById('lat').value=results[0].geometry.location.lat();
          document.getElementById('lng').value=results[0].geometry.location.lng();
          marker = new google.maps.Marker({
            map: map,
            position: results[0].geometry.location
          });
        } else {
          console.log('検索に失敗しました' + status);
        }
      });
     
      map.addListener('click', function(e) {
        getClickLatLng(e.latLng, map);
      });
      function getClickLatLng(lat_lng, map) {
        document.getElementById('lat').value=lat_lng.lat();
        document.getElementById('lng').value=lat_lng.lng();
        marker.setMap(null);
        marker = new google.maps.Marker({
          position: lat_lng,
          map: map
        });
        map.panTo(lat_lng);
      }
    }
  
    return {
      getAddress: function() {
        var button = document.getElementById("map_button");
        button.onclick = function() {
          var address = document.getElementById("address").value;
          codeAddress(address);
        }
        window.onload = function(){
        var address = document.getElementById("address").value;
        codeAddress(address);
        }
      }
    };
    })();
    getMap.getAddress();
    }
    </script>

@endsection