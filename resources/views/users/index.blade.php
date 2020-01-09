<!doctype html>
<html>
<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <head>
</head>
<body>
@extends('home-layout')
@section('content')
<ul>
@foreach($users as $user)
<li>{{$user->firstName}}</li>
@endforeach
</ul>
@stop
</body>
</html>