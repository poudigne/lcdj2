<!DOCTYPE html>
<html>
<head>
@include('meta')
</head>
<body style="background-color:#e6eff2">
	@include('menu')
	@include('header')
	<main>
					@yield('content')
	</main>
		@include('footer')
</body>
</html>

