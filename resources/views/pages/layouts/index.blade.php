<html>
<head>
    <title>Page - @yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
</head>
<body>

<div class="container mt-5">
    @yield('content')
</div>

<script src="{{mix('js/app.js')}}"></script>
</body>
</html>
