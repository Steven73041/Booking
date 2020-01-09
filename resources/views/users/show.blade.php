@extends('home-layout')
@section('PageTitle', 'User')
@section('content')
<p>{{$user->lastName}}</p>
@endsection
