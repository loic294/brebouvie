@extends('layouts/main')

@section('content_main')

<div class="jumbotron">
  <h1>{{ $user->prenom }} {{ $user->nom }}</h1>
</div>
<div class="row">
  <div class="col-sm-6">
    <div class="jumbotron small">
      <h1>{{ $stats['threads'] }} <small>conversations</small></h1>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="jumbotron small">
      <h1>{{ $stats['messages'] }} <small>messages</small></h1>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-sm-6">
    <div class="jumbotron small">
      <h1>{{ $stats['words'] }} <small>mots</small></h1>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="jumbotron small">
      <h1>{{ round($stats['words'] / ($stats['messages'] == 0 ? 1 : $stats['messages']), 2) }} <small>mots / message</small></h1>
    </div>
  </div>
</div>

<h2>Conversations</h2>

<table class="table table-striped">
  <thead>
    <tr>
      <th>#</th>
      <th>Nom</th>
      <th>Ouvrir</th>
    </tr>
  </thead>
  <tbody>
    @foreach($threads as $thread)
      <tr>
        <td>{{ $thread->id }}</td>
        <td>{{ $thread->subject }}</td>
        <td><a href="{{URL::to('gestion/messages/' . $thread->id )}}">Ouvrir</a></td>
      </tr>
    @endforeach

  </tbody>
</table>

<h2>Messages</h2>
<table class="table table-striped">
  <thead>
    <tr>
      <th>#</th>
      <th>Nom</th>
      <th>Ouvrir</th>
    </tr>
  </thead>
  <tbody>
    @foreach($messages as $message)
      <tr>
        <td>{{ $message->id }}</td>
        <td>{!! Markdown::convertToHtml($message->body) !!}</td>
        <td><a href="{{URL::to('gestion/messages/' . $message->thread_id )}}">Ouvrir</a></td>
      </tr>
    @endforeach

  </tbody>
</table>


<form class="form-horizontal" method="POST" action="{{URL::to('/gestion/users/' . $user->id) }}">
  <input type="hidden" name="_method" value="PATCH" />
  {{ csrf_field() }}
  <fieldset>
    <legend>Ajouter un utilisateur</legend>
    <div class="form-group">
      <label class="col-lg-1 control-label">DA</label>
      <div class="col-lg-11">
        <input  type="text" name="da" class="form-control" value="{{ $user->da }}">
      </div>
    </div>
    <div class="form-group">
      <label class="col-lg-1 control-label">Prénom</label>
      <div class="col-lg-11">
        <input  type="text" name="prenom" class="form-control" value="{{ $user->prenom }}">
      </div>
    </div>
    <div class="form-group">
      <label class="col-lg-1 control-label">Nom</label>
      <div class="col-lg-11">
        <input  type="text" name="nom" class="form-control" value="{{ $user->nom }}">
      </div>
    </div>
    <div class="form-group">
      <label class="col-lg-1 control-label">Email</label>
      <div class="col-lg-11">
        <input  type="text" name="email" class="form-control" value="{{ $user->email }}">
      </div>
    </div>
    <div class="form-group">
      <label for="inputNom" class="col-lg-1 control-label">Role</label>
      <div class="col-lg-11">
        <select class="form-control" name="role">
          @foreach($roles as $role)
            <option value="{{ $role->id }}" {{ $user->userType == $role->id ? "selected" : "" }} >{{ $role->nom }}</option>
          @endforeach

        </select>
      </div>
    </div>
    <div class="form-group">
      <div class="col-lg-11 col-lg-offset-1">
        <button type="submit" class="btn btn-primary">Modifier</button>
      </div>
    </div>
  </fieldset>
  </form>


@endsection
