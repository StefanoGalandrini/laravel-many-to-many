<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Admin Base Login</title>
	@vite('resources/js/app.js')
</head>

<body>
	@include('admin.includes.header')

	<div class="container-fluid d-flex align-items-center justify-content-center mt-5 mb-5 p-5 rounded border">

		<main class="w-75">
			@yield('contents')
		</main>

	</div>

	@include('admin.includes.footer')
</body>

</html>
