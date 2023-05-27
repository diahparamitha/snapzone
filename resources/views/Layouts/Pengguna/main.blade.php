<!DOCTYPE html>
<html>
<head>
	@include('Layouts/Pengguna/Partials/head')
</head>
<body>

	@include('Layouts/Pengguna/Partials/navbar')

	@include('Layouts/Pengguna/Partials/hero')

		@yield('content')

	@include('Layouts/Pengguna/Partials/footer')

</body>
</html>