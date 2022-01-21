<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Sistema Amigo Secreto</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Rancho&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('css/initial.css')}}">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <style>
            html,
            body {
            height: 100%;
            }
            body {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-align: center;
            align-items: center;
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #D6FFC8;
            }
        </style>
    </head>
    <body class="bg-light">
        <div class="container">
            <div class="py-5 text-center">
            <img src="{{ asset('img/logo.svg') }}" alt="">

                @if (Route::has('login'))
                    <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                        @auth
                            <a href="{{ url('/home') }}" style="color:black; text-decoration:none; font-weight: bolder; font-family: Rancho; font-size:20px" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
                        @else
                            <a href="{{ route('login') }}" style="color:black; text-decoration:none; font-weight: bolder; font-family: Rancho; font-size:20px" class="text-sm text-gray-700 dark:text-gray-500 "> Login⠀⠀⠀⠀⠀⠀⠀|</a>
                            &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" style="color:black; text-decoration:none; font-weight: bolder; font-family: Rancho; font-size:20px" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">⠀ Registre-se </a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </body>
</html>