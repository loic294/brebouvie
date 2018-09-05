@extends('layouts/base')

@section('content')

<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Brébouvie</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
      <ul class="nav navbar-nav">
        <li @if(Request::is('nouvelles*'))class="active"@endif><a href="{{URL::to('/nouvelles')}}">Nouvelles</a></li>
        <li @if(Request::is('messages*'))class="active"@endif><a href="{{URL::to('/messages')}}">Messages</a></li>
        @if(Auth::user()->role()->first()->userType > 2)
          <li @if(Request::is('gestion*'))class="active"@endif><a href="{{URL::to('/gestion')}}">Gestion</a></li>
        @endif
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">{{ Auth::user()->prenom }} {{ Auth::user()->nom }}</a></li>
        <li><a href="{{URL::to('/logout')}}" title="Déconnexion"><i class="fa fa-sign-out" aria-hidden="true"></i></a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="main-user-container">

      @if(Session::has('success_message'))
        <div class="alert alert-success" role="alert">{{Session::get('success_message')}}</div>
      @endif

      @yield('content_main')


</div>
@endsection
