@extends('layouts/main')

@section('content_main')

<div class="row">
  <div class="col-sm-8">
    <div class="jumbotron">
      <div class="container">
        <h1>Gestion du site</h1>
        <p class="lead">Section d'administration du site | <b>Année : {{ $annee->nom }}</b> </p>
      </div>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="panel panel-default">
      <div class="panel-body">
        <ul class="nav nav-pills nav-stacked">
          <li role="presentation"><a href="{{ URL::to('gestion/messages') }}">Messages</a></li>
          <li role="presentation"><a href="{{ URL::to('gestion/users') }}">Utilisateurs</a></li>
          <li role="presentation"><a href="{{ URL::to('gestion/roles') }}">Rôles</a></li>
          <li role="presentation"><a href="{{ URL::to('gestion/annees') }}">Années</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-sm-4">
    <div class="panel panel-default">
      <div class="panel-body">

        <h2>Changer d'année</h2>
        <ul class="nav nav-pills nav-stacked">

          @foreach($annees as $a)
            <li role="presentation"><a href="{{ URL::to('gestion/annees/' . $a->id) }}">{{ $a->nom }}</a></li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
</div>



@endsection
