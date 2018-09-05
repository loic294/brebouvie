@extends('layouts/main')

@section('content_main')

<div class="message-container">

  <div class="message-list-container">
      <div class="threads-list-container">
        @foreach($threads as $thread)
          <a href="{{URL::to('gestion/messages/' . $thread->id )}}">
            <div class="list-item {{(isset($id) && $thread->id == $id) ? 'active' : ''}}">
              <b>{{$thread->subject}}</b>
            </div>
          </a>
        @endforeach
      </div>
  </div>

  <div class="message-detail-container">

    @if(isset($messages))
      <div class="messages" style="top: 0;">
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


@include('footer')

<script>
  $('.messages a').attr('target', '_blank');
</script>

@endsection
