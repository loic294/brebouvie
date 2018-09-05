@extends('layouts/main')

@section('content_main')
<div class="container">
@if(Auth::user()->role()->first()->userType > 1)
  <a href="{{URL::to('/nouvelles/create')}}" class="btn btn-success btn-lg">Nouvel article</a>
  <br/><br/>
@endif

  <div class="nouvelles">
    @foreach($messages as $message)

    <a href="{{URL::to('nouvelles/'.$message->id)}}">

      <div class="panel panel-default">
        <div class="panel-body">
          <h1>{{$message['nom']}}</h1>

          {!! mb_strimwidth(strip_tags(Markdown::convertToHtml($message['body'])), 0, 340, '...') !!}

          @if( (Auth::user()->userType == 2 && Auth::user()->id == $message['user_id']) || Auth::user()->role()->first()->userType > 2 )
            <form class="form-horizontal delete" method="POST" action="{{URL::to('/nouvelles'). '/' . $message['id'] }}">
              <input type="hidden" name="_method" value="DELETE" />
              {{ csrf_field() }}
              <a href="{{URL::to('/nouvelles/' . $message['id'] . '/edit' )}}" class="btn btn-primary">Modifier</a>
              <button class="btn btn-danger submit" type="submit" data-toggle="modal" data-target="#deleteModal">Supprimer</button>
          </form>
          @endif

        </div>
      </div>

    </a>

    @endforeach
  </div>


<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" >
  <div class="modal-dialog"  role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Supprimer un article</h4>
      </div>
      <div class="modal-body">
        <p>Voullez vous vraiment supprimer cet article ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
        <button type="button" class="btn btn-danger confirm">Supprimer</button>
      </div>
    </div>
  </div>
</div>
 </div>
<script>

var form;
$('.submit').click(function(e){
    e.preventDefault();
    form = $(this).closest('form');
    console.log('form', form);
});

$('.confirm').click(function(){
    form.submit();
});

$(document).ready(function(){
  $('.panel a').attr('target', '_blank');
});

</script>


@endsection
