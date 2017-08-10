<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/inayat.css') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    @yield('custom-css')
</head>
<body>
@include('layout.header')

@yield('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="{{ asset('js/script.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/inayat.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/app.js') }}" ></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="https://use.fontawesome.com/08f92b851e.js"></script>
</body>
</html>