@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
  <div class="row">
    <div class="col-sm-3">
      <div class="box box-danger">
        <div class="box-body box-profile">
          <img class="profile-user-img img-responsive img-circle" src="{{asset('img/defaultuser.png')}}" alt="User profile picture">
          <h3 class="profile-username text-center">{{auth()->user()->name}}</h3>
          <ul class="list-group list-group-unbordered">
            <li class="list-group-item">
              <b>Email address</b> <a class="pull-right">{{auth()->user()->email}}</a>
            </li>
            <li class="list-group-item">
              <b>Member since</b> <a class="pull-right">{{auth()->user()->created_at}}</a>
            </li>
            <li class="list-group-item">
              <b>Friends</b> <a class="pull-right">13,287</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
@stop
