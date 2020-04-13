@extends('layouts/app')

@section('content')

<div class="col-md-7 m-auto py-2 py-md-5" id="single-post">
   <h3>{{$post->title}}</h3>
   <div>
       <img class="" src="/images/single-post-photos/{{$post->src}}" width="100%">
       <div class="social">
           
       </div>
    </div>
    <div>
        {{$post->body}}
    </div>
</div>

@endsection