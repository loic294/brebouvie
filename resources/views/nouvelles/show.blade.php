@extends('layouts/main')

@section('content_main')


  <div class="nouvelle">

          <h1>{{$message['nom']}}</h1>

          {!! Markdown::convertToHtml($message['body']) !!}

          @if( (Auth::user()->userType == 2 && Auth::user()->id == $message['user_id']) || Auth::user()->role()->first()->userType > 2 )


            <!-- <form class="form-horizontal delete" method="POST" action="{{URL::to('/nouvelles'). '/' . $message['id'] }}">
              <input type="hidden" name="_method" value="DELETE" />
              {{ csrf_field() }}
              <a href="{{URL::to('/nouvelles/' . $message['id'] . '/edit' )}}" class="btn btn-primary">Modifier</a>
              <button class="btn btn-danger submit" type="submit" data-toggle="modal" data-target="#deleteModal">Supprimer</button>
          </form> -->
          @endif


  </div>



@endsection
