@extends('layouts/app')

@section('content')

<Category
:authmain="@if(Auth::check() && Auth::user()->is_admin == 1 && count(Auth::user()->category) == 0) true @else false @endif"
:authcat="{{$authcat}}"
:user="{{$user}}"
:category="{{json_encode($category)}}"
:posts="{{json_encode($posts)}}"
></Category>

@endsection