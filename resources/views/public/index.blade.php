@extends('public.layouts.master')

@section('content')
    <h1>{{Auth::user()?->name}}</h1>
    <a href="{{route('logout')}}">hjghjh</a>
@endsection