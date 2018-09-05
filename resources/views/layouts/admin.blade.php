@extends('layouts/main')

@section('content_main')

<div id="admin">

		<div class="left-menu">
			<ul class="nav nav-pills nav-stacked">
				<li role="presentation"><a href="{{ URL::to('gestion') }}">Accueil</a></li>
				<li role="presentation"><a href="{{ URL::to('gestion/messages') }}">Messages</a></li>
				<li role="presentation"><a href="{{ URL::to('gestion/users') }}">Utilisateurs</a></li>
				<li role="presentation"><a href="{{ URL::to('gestion/roles') }}">Rôles</a></li>
				<li role="presentation"><a href="{{ URL::to('gestion/annees') }}">Années</a></li>
			</ul>
		</div>

		<div class="admin-content">

		<div class="container">

     @yield('page')
	 	</div>

	 	</div>

</div>

@endsection
