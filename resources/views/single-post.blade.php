@extends('layouts/app')

@section('content')

<Singlepost 
:post="{{json_encode($post)}}" 
:authmain="
@if(Auth::check() && Auth::user()->is_admin == 1 && count(Auth::user()->category) == 0)
true
@else
false
@endif">
></Singlepost>

@endsection