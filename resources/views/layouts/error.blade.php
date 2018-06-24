<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>@if(App::isLocale('en')) 404 Page no found @else 404 Halaman Tidak Ditemukan @endif</title>
	<meta name="viewport" content="width=device-width">
    <!-- Styles -->
    <link href="{{ asset('css/404.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
	<div class="error-page-wrap">
		<article class="error-page gradient">
			<hgroup>
				<h1>404</h1>
				<h2>oops! @if(App::isLocale('en')) Page no found @else Halaman Tidak Ditemukan @endif</h2>
			</hgroup>
			<a href="{{ URL::previous() }}" title="Back to site" class="error-back">back</a> | <a href="/" title="Back to site" class="error-back">home</a> 
		</article>
	</div>
</body>
</html>