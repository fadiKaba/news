@extends('layouts/app')

@section('content')

@include('layouts/main-page-nav')

<Maincomponent 
:authmain="@if(Auth::check() && Auth::user()->is_admin == 1 && count(Auth::user()->category) == 0)
true
@else
false
@endif">
</Maincomponent>

@endsection