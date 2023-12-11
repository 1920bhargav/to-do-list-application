<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{asset('assets/css/authentication/form-2.css')}}" rel="stylesheet" type="text/css" />
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            background-image: url(../assets/img/bg_ttagz.jpg);
        }
        .submit-btn {
            border-color: #b64267;
            background: linear-gradient(#e74367, #ae4578);
        }
        .submit-btn:hover { 
            border-color: #b64267;
        }
    </style>
</head>
<body>
    <div id="app">
        
        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>
