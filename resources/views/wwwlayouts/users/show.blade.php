@extends('wwwlayouts.default')
@section('title','个人中心')

@section('content')
<h1>个人中心</h1>
<p>{{ $user->username}}</p>
<p>{{ $user->email}}</p>
<p>{{ $user->phone}}</p>
@stop