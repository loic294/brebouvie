<!doctype html>
<html lang="fr">
	<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta name="theme-color" content="#4c4d57">

        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>@yield('page_title')</title>
        <link rel="icon" href="{{url('/')}}/favicon.ico" />

				<script src="https://use.fontawesome.com/e2786a9355.js"></script>

				<!-- Latest compiled and minified CSS -->
				<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
				<link rel="stylesheet" href="{{asset('css/easy-autocomplete.min.css')}}" >
        <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}" />

				<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
				<script src="{{asset('js/jquery.easy-autocomplete.min.js')}}"></script>
				<script src="{{asset('js/autogrow.min.js')}}"></script>
				<!-- Latest compiled and minified JavaScript -->
				<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>



	</head>
	<body>


     @yield('content')

    </body>
</html>
