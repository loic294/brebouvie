
@extends('layouts.base')

@section('page_title', 'Inscription / Connexion')

@section('content')

<div class="jumbotron">
  <div class="container">
    <h1>Brébouvie</h1>
    <p>This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
  </div>
</div>

<div class="container">

  <div class="row">
    <div class="col-sm-6">
      <form  class="form-horizontal" method="POST" action="{{ URL::to('/store')}}">
        {!! csrf_field() !!}
        <fieldset>
          <legend>Créer un compte</legend>

          @if(Session::has('erreur'))
          <div class="alert alert-danger">
            <strong>Oups!</strong> {{Session::get('erreur')}}
          </div>
          @endif

          @if (count($errors) > 0)
              <div class="alert alert-danger">
                  <strong>Oups!</strong>
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif

          <div class="form-group">
            <label for="inputDA" class="col-lg-3 control-label">Numéro de DA</label>
            <div class="col-lg-9">
              <input type="text" class="form-control" name="da" value="{{ old('da') }}" id="inputDA" placeholder="Numéro de DA">
            </div>
          </div>

          <div class="form-group">
            <label for="inputEmail" class="col-lg-3 control-label">Courriel</label>
            <div class="col-lg-9">
              <input type="email" class="form-control" name="email" value="{{ old('email') }}" id="inputEmail" placeholder="Courriel">
            </div>
          </div>

          <div class="form-group">
            <label for="inputPrenom" class="col-lg-3 control-label">Prénom</label>
            <div class="col-lg-9">
              <input type="text" class="form-control" name="prenom" value="{{ old('prenom') }}" id="inputPrenom" placeholder="Prénom">
            </div>
          </div>

          <div class="form-group">
            <label for="inputNom" class="col-lg-3 control-label">Nom</label>
            <div class="col-lg-9">
              <input type="text" class="form-control" name="nom" value="{{ old('nom') }}" id="inputNom" placeholder="Nom">
            </div>
          </div>

          <div class="form-group">
            <label for="inputPassword" class="col-lg-3 control-label">Mot de passe</label>
            <div class="col-lg-9">
              <input type="password" class="form-control" name="password" value="{{ old('password') }}" id="inputPassword" placeholder="Mot de passe">
            </div>
          </div>

          <div class="form-group">
            <label for="inputPasswordConf" class="col-lg-3 control-label">Confirmation</label>
            <div class="col-lg-9">
              <input type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}" id="inputPasswordConf" placeholder="Mot de passe (confirmation)">
            </div>
          </div>

          <div class="form-group">
            <div class="col-lg-9 col-lg-offset-3">
              <button type="submit" class="btn btn-primary">Créer mon compte</button>
            </div>
          </div>
        </fieldset>
      </form>
    </div>
    <div class="col-sm-6">

      <form  class="form-horizontal" method="POST" action="{{URL::to('/login')}}">
        {!! csrf_field() !!}
        <fieldset>
          <legend>Connexion</legend>

          <div class="form-group">
            <label for="inputEmail" class="col-lg-3 control-label">DA ou courriel</label>
            <div class="col-lg-9">
              <input type="text" class="form-control" name="email" value="{{ old('email') }}" id="inputEmail" placeholder="DA ou courriel">
            </div>
          </div>

          <div class="form-group">
            <label for="inputPassword" class="col-lg-3 control-label">Mot de passe</label>
            <div class="col-lg-9">
              <input type="password" class="form-control" name="password" value="{{ old('password') }}" id="inputPassword" placeholder="Mot de passe">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="remember" value="{{ old('remember') }}"> Se rappeler de moi
                </label>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="inputPassword" class="col-lg-3 control-label"></label>
            <div class="col-lg-9">

                <label>
                  <a href="{{ URL::to('password/email') }}">Mot de passe oublié?</a>
                </label>
          
            </div>
          </div>

          <div class="form-group">
            <div class="col-lg-9 col-lg-offset-3">
              <button type="submit" class="btn btn-primary">Connexion</button>
            </div>
          </div>


        </fieldset>
      </form>

    </div>
  </div>

</div>



@endsection
