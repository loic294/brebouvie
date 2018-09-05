@extends('layouts/main')

@section('content_main')

<div class="jumbotron">
  <div class="container">
    <h1>Années</h1>
  </div>
</div>

<form class="form-horizontal" method="POST" action="{{URL::to('/gestion/annees') }}">
  <input type="hidden" name="_method" value="POST" />
  {{ csrf_field() }}
  <fieldset>
    <legend>Ajouter une années</legend>
    <div class="form-group">
      <label for="inputNom" class="col-lg-1 control-label">Nom</label>
      <div class="col-lg-11">
        <input  type="text" name="nom" class="form-control" id="inputNom" placeholder="Nom"
                value="{{ old('nom') }}">
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
    </tr>
  </thead>
  <tbody>
    @foreach($annees as $annee)
      <tr>
        <td>{{ $annee->id }}</td>
        <td>{{ $annee->nom }}</td>
        <td>{{ $annee->slug }}</td>
      </tr>
    @endforeach

  </tbody>
</table>

<script>


</script>


@endsection
