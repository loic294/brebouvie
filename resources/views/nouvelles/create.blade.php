@extends('layouts/main')

@section('content_main')
<div class="container">
    <!-- <div class="well well-lg">
      <h5>Utilisez les commandes suivantes pour rédiger votre texte</h5>
      <div class="row">
        <div class="col-sm-4">
          <b>Titre 1</b> : # titre 1 <br/>
          <b>Titre 2</b> : ## titre 2 <br/>
          <b>Titre 3</b> : ### titre 3 <br/>
          <b>Titre 4</b> : #### titre 4 <br/>
        </div>
        <div class="col-sm-8">
          <b>URL</b> : [nom du contenu](http://exemple.com) <br/>
          <b>Image</b> : ![description de l'image](http://exemple.com/image.jpg) <br/>
          <b>Italic</b> : *du texte itlic* <br/>
          <b>Gras</b> : **du texte gras**
        </div>
      </div>
    </div> -->

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

    <form class="form-horizontal" method="POST" action="{{URL::to('/nouvelles') . (isset($message) ? "/" . $message['id'] : "") }}" enctype="multipart/form-data">
      <input type="hidden" name="_method" value="{{ isset($message) ? 'PUT' : 'POST' }}" />
      {{ csrf_field() }}
      <fieldset>
        <legend>Ajouter une nouvelle</legend>

        <div class="form-group">
          <label for="inputEmail" class="col-lg-1 control-label">Titre</label>
          <div class="col-lg-11">
            <input  type="text" name="nom" class="form-control" id="inputEmail" placeholder="Titre de l'article"
                    value="{{ !isset($message) ? old('nom') : (isset($message) ? $message['nom'] : "" ) }}">
          </div>
        </div>

        <div class="form-group">
          <label for="inputEmail" class="col-lg-1 control-label">Fichier</label>
          <div class="col-lg-11">
            <input type="file" name="upload" />
          </div>
        </div>

        <div class="form-group">
          <label for="textArea" class="col-lg-1 control-label">Contenu</label>
          <div class="col-lg-11">
            <textarea id="editor1" name="body">{!! isset($message) ? Markdown::convertToHtml($message['body']) : old('body') !!}</textarea>
          </div>
        </div>

        <div class="form-group">
          <div class="col-lg-11 col-lg-offset-1">
            <button type="submit" class="btn btn-primary">{{ isset($message) ? "Modifier" : "Ajouter" }}</button>
          </div>
        </div>
      </fieldset>
      </form>


      <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
      <script>
        CKEDITOR.replace( 'editor1' );
      </script>
</div>
@endsection
