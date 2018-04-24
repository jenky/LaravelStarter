<!doctype html>
<html lang="@yield('htmlLang', app()->getLocale())" class="@yield('htmlClass')">
<head>
    @section('head')
    <meta charset="@yield('charset', 'utf-8')">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @stack('meta')

    <title>@yield('title', config('app.name'))</title>

    @stack('css')

    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    @show
</head>
<body class="@yield('bodyClass')">
    @yield('body')
    @stack('js')
</body>
</html>
