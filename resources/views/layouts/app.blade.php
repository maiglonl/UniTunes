<!DOCTYPE html>
<html lang="en" class="app">
	<head>
		<meta charset="utf-8"/>
		<title>{{ config('app.name', 'UniTunes') }}</title>
		<meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- CSRF Token -->
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<link rel="stylesheet" href="{{ URL::asset('js/jPlayer/jplayer.flat.css') }}" type="text/css" />
		<link rel="stylesheet" href="{{ URL::asset('css/bootstrap.css') }}" type="text/css" />
		<link rel="stylesheet" href="{{ URL::asset('css/animate.css') }}" type="text/css" />
		<link rel="stylesheet" href="{{ URL::asset('css/font-awesome.min.css') }}" type="text/css" />
		<link rel="stylesheet" href="{{ URL::asset('css/simple-line-icons.css') }}" type="text/css" />
		<link rel="stylesheet" href="{{ URL::asset('css/font.css') }}" type="text/css" />
		<link rel="stylesheet" href="{{ URL::asset('css/app.css') }}" type="text/css" />  
		<!--[if lt IE 9]>
			<script src="{{ URL::asset('js/ie/html5shiv.js') }}"></script>
			<script src="{{ URL::asset('js/ie/respond.min.js') }}"></script>
			<script src="{{ URL::asset('js/ie/excanvas.js') }}"></script>
		<![endif]-->

		@yield('appJsLibs')

		<script>
			window.Laravel = <?php echo json_encode([
				'csrfToken' => csrf_token(),
			]); ?>
		</script>
		@yield('appHeader')
	</head>

	<body>

		@yield('appContent')

		<script src="{{ URL::asset('js/jquery.min.js') }}"></script>
		<script src="{{ URL::asset('js/file-input/bootstrap-filestyle.min.js') }}"></script>
		<script src="{{ URL::asset('js/bootstrap.js') }}"></script>
		<script src="{{ URL::asset('js/app.layout.js') }}"></script>  
		<script src="{{ URL::asset('js/slimscroll/jquery.slimscroll.min.js') }}"></script>
		<script src="{{ URL::asset('js/app.plugin.js') }}"></script>
		<script src="{{ URL::asset('js/jPlayer/jquery.jplayer.min.js') }}"></script>
		<script src="{{ URL::asset('js/jPlayer/add-on/jplayer.playlist.min.js') }}"></script>
		<script src="{{ URL::asset('js/jPlayer/demo.js') }}"></script>

		@yield('appFooter')

	</body>
</html>
