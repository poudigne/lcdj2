<!DOCTYPE html>
<html>
<head>
@include('dashboard/meta')
</head>
<body>
	@include('dashboard/header')
	@include('dashboard/sidebar')

	<div class="container">
		<div class='row'>
			<div class="col-lg-12">
				@include('dashboard/breadcrumbs')
				@yield('content')
			</div>
		</div>
	</div>
</body>
</html>

