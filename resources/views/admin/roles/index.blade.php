@extends('layouts/main')

@section('content_main')

<div class="jumbotron">
  <div class="container">
    <h1>Rôles</h1>
  </div>
</div>

<form class="form-horizontal" method="POST" action="{{URL::to('/gestion/roles') }}">
  <input type="hidden" name="_method" value="POST" />
  {{ csrf_field() }}
  <fieldset>
    <legend>Ajouter une nouvelle</legend>
    <div class="form-group">
      <label for="inputNom" class="col-lg-1 control-label">Nom</label>
      <div class="col-lg-11">
        <input  type="text" name="nom" class="form-control" id="inputNom" placeholder="Nom"
                value="{{ old('nom') }}">
      </div>
    </div>
    <div class="form-group">
      <label for="inputNom" class="col-lg-1 control-label">Type</label>
      <div class="col-lg-11">
        <select name="userType" class="form-control">
          <option value="1">1 - Régulier (peut envoyer des messages)</option>
          <option value="2">2 - Journaliste (peut écrire des articles dans le journal)</option>
          <option value="3">3 - Professeur</option>
          <option value="4">4 - Administrateur</option>
        </select>
      </div>
    </div>
    <div class="form-group">
      <div class="col-lg-11 col-lg-offset-1">
        <button type="submit" class="btn btn-primary">Ajouter</button>
      </div>
    </div>
  </fieldset>
  </form>

<table class="table table-striped">
  <thead>
    <tr>
      <th>#</th>
      <th>Nom</th>
      <th>Slug</th>
      <th>Type d'utilisateur</th>
    </tr>
  </thead>
  <tbody>
    @foreach($roles as $role)
      <tr>
        <td>{{ $role->id }}</td>
        <td>{{ $role->nom }}</td>
        <td>{{ $role->slug }}</td>
        <td>{{ $role->userType }}</td>
      </tr>
    @endforeach

  </tbody>
</table>

<script>


</script>


@endsection
