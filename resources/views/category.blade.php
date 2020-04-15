@extends('layouts/app')

@section('content')
{{dd(Auth::user()->category)}}
<Category
:post="{{json_encode($post)}}" 
:authmain="@if(Auth::check() && Auth::user()->is_admin == 1 && count(Auth::user()->category) == 0) true @else false @endif"
:authcat="@if(Auth::check() && Auth::user()->is_admin == 1 && count(Auth::user()->category) != 0) {{Auth::user()->category}} @else false @endif"
></Category>

@endsection