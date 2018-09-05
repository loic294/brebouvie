@extends('layouts/main')

@section('content_main')

<div class="jumbotron">
  <div class="container">
    <h1>Utilisateurs</h1>
  </div>
</div>

<form class="form-horizontal" method="POST" action="{{URL::to('/gestion/users') }}">
  <input type="hidden" name="_method" value="POST" />
  {{ csrf_field() }}
  <fieldset>
    <legend>Ajouter un utilisateur</legend>
    <div class="form-group">
      <label for="inputNom" class="col-lg-1 control-label">DA</label>
      <div class="col-lg-11">
        <input  type="text" name="da" class="form-control" id="inputNom" placeholder="DA"
                value="{{ old('da') }}">
      </div>
    </div>
    <div class="form-group">
      <label for="inputNom" class="col-lg-1 control-label">Role</label>
      <div class="col-lg-11">
        <select class="form-control" name="role" value="{{ old('role') }}">
          @foreach($roles as $role)
            <option value="{{ $role->id }}">{{ $role->nom }}</option>
          @endforeach

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
      <th>DA</th>
      <th>Prénom</th>
      <th>Nom</th>
      <th>Courriel</th>
      <th>Rôle</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @foreach($users as $user)
      <tr>
        <td>{{ $user->id }}</td>
        <td>{{ $user->da }}</td>
        <td>{{ $user->prenom }}</td>
        <td>{{ $user->nom }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->role()->first()->nom }}</td>
        <td><a href="{{ URL::to('gestion/users/' . $user->id) }}">Ouvrir</a></td>

      </tr>
    @endforeach

  </tbody>
</table>

<script>


</script>


@endsection
