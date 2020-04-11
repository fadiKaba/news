@extends('layouts/app')

@section('content')

<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
    <li class="nav-item" v-on:click="getTime">
      <a class="nav-link main-btn mr-2 active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Users</a>
    </li>
    <li class="nav-item" v-on:click="getTime">
      <a class="nav-link main-btn mr-2" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Admins</a>
    </li>
    <li class="nav-item">
      <a class="nav-link main-btn" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Add User</a>
    </li>
</ul>
<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
        <Userclient :users={{$usersClient}} :time="time"></Userclient>
    </div>
    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
        <span class="bg-secondary text-white px-3 py-1">A d m i n s</span>
        <Useradmin :users="{{$users}}" :time="time"></Useradmin>
    </div>
    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">...</div>
</div>


@endsection