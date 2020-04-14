@extends('layouts/app')

@section('content')

<Singlepost :post="{{json_encode($post)}}"></Singlepost>

@endsection