@extends('layouts/main')

@section('content_main')

<div class="message-container">

  <div class="message-list-container">
      <div class="nouvelle-convo-btn-container">
        <button class="btn btn-success btn-lg btn-block" data-toggle="modal" data-target="#nouveauModal">Nouveau message</button>
      </div>
      <div class="threads-list-container">
        @foreach($threads as $thread)
          <a href="{{URL::to('/messages/' . $thread->id )}}">
            <div class="list-item {{(isset($id) && $thread->id == $id) ? 'active' : ''}}">
              <b>{{$thread->subject}}</b>
            </div>
          </a>
        @endforeach
      </div>
  </div>

  <div class="message-detail-container">



    @if(isset($messages))
      <div class="nouveau-message-container">
        <form class="form-horizontal" method="POST" action="{{URL::to('/messages/' . $id) }}" enctype="multipart/form-data">
            <input type="hidden" name="_method" value="PUT" />
            {{ csrf_field() }}
            <fieldset>

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
                  <textarea name="body" class="form-control" rows="3" required placeholder="Composer votre message ici...">{{ old('body') }}</textarea>
                  <span class="help-block">Vous pouvez utiliser du <a href="https://github.com/adam-p/markdown-here/wiki/Markdown-Cheatsheet" target="_blank">Markdown</a> pour fonrmater votre texte.</span>
              </div>

              <input type="file" name="upload" style="display:none" />

              <div class="form-group">
                  <button type="button" class="btn btn-default addFile">Envoyer un fichier</button>
                  <button type="submit" class="btn btn-primary">Envoyer</button>
              </div>
            </fieldset>
        </form>

      </div>

      <div class="messages">
          <div class="row">
            @foreach($messages as $message)
              <div class="col-sm-9 {{$message->user_id == Auth::user()->id ? 'col-md-offset-3' : ''}}">
                <small>{{$message->prenom}} {{$message->nom}}</small>
                <div class="well well-sm {{$message->user_id == Auth::user()->id ? 'me' : 'other'}}">
                  {!! Markdown::convertToHtml($message->body) !!}
                </div>
              </div>
            @endforeach
          </div>
      </div>

    @else

      <div class="empty">
        @if(session('status'))
        <div class="alert alert-dismissible alert-danger">
          <strong>Oups!</strong> {{session('status')}}
        </div>
        @endif
        <h4>Sélectionnes une conversation ou crées en un nouvelle pour commencer.</h4>
      </div>

    @endif
  </div>


</div>

<form class="form" method="POST" action="{{URL::to('/threads')  }}">
  <div class="modal fade" id="nouveauModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Ajouter un contact</h4>
        </div>
        <div class="modal-body">


            <input type="hidden" name="_method" value="POST" />
            {{ csrf_field() }}
            <fieldset>

              <div class="form-group">
                <input name="name" type="text" class="form-control" placeholder="Nommez la conversation" required/>
              </div>

              <div class="row">
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="addUser" placeholder="Nom d'une personne" />
                </div>
                <div class="col-sm-3">
                  <button type="button" class="btn btn-default ajouter">Ajouter</button>
                </div>
              </div>

              <div class="hidden-fields">
                <input type="hidden" name="user{{Auth::user()->id}}" value="{{Auth::user()->id}}" />
              </div>

              <div class="list-group contacts">
                <a href="#" class="list-group-item">{{Auth::user()->prenom}} {{Auth::user()->nom}} ({{Auth::user()->role()->first()->nom}})</a>
              </div>

            </fieldset>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Créer la conversation</button>
        </div>
      </div>
    </div>
  </div>
</form>

@include('footer')

<script>

var selectedUser = {};

var options = {
	data: users,
  getValue: function(element) {
  	return element.prenom + " " + element.nom + " (" + element.role.nom + ")" ;
  },
  list: {
		match: {
			enabled: true
		},
    onSelectItemEvent: function() {
			selectedUser = $("#addUser").getSelectedItemData();
		}
	}
};

$("#addUser").easyAutocomplete(options);

var index = 0;

$('.ajouter').click(function(){

  if(!$('input[name=user'+selectedUser.id+']').val()) {
    $('.hidden-fields').append(
      '<input type="hidden" name="user' + selectedUser.id + '" value="' + selectedUser.id + '" />'
    );
    $('.contacts').append(
      '<a href="#" class="list-group-item">' + selectedUser.prenom + ' ' + selectedUser.nom  +'('+ selectedUser.role.nom +')</a>'
    );
    $('#addUser').val("");
  }

});

$('textarea').autogrow();

$('.addFile').click(function(){
  $("input[name=upload]").click();
});

$("input[name=upload]").change(function() {
    var form = $(this).closest("form");
    form.find('textarea[name=body]').val(form.find('textarea[name=body]').val() + '\n\n_Fichier joint :_ ');
    form.submit();
});

$('.messages a').attr('target', '_blank');

</script>

@endsection
