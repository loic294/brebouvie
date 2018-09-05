
@extends('layouts.base')

@section('page_title', 'Inscription / Connexion')

@section('content')

<div class="jumbotron">
  <div class="container">
    <h1>Mot de passe</h1>
  </div>
</div>

<div class="container">

  <form class="form-horizontal" method="POST" action="{{URL::to('/password/email')}}">
      {!! csrf_field() !!}

      @if (count($errors) > 0)
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      @endif

      <div class="form-group">
        <label for="inputEmail" class="col-lg-3 control-label">Courriel</label>
        <div class="col-lg-9">
          <input type="email" class="form-control" name="email" value="{{ old('email') }}" id="inputEmail" placeholder="Courriel">
        </div>
      </div>

      <div class="form-group">
        <div class="col-lg-9 col-lg-offset-3">
          <button  class="btn btn-primary" type="submit">
              Envoyer le courriel
          </button>
        </div>
      </div>
  </form>


</div>



@endsection
