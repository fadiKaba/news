@extends('layouts/app')

@section('content')

<Useradmin :users="{{$users}}"></Useradmin>

@endsection