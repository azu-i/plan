<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <title>@yield('title')</title>

            <script src="{{asset('js/app.js') }}" defer></script>
            @yield('js')

             <!-- Fonts -->
             <link rel="dns-prefetch" href="https://fonts.gstatic.com">
             <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

             <!-- Styles -->
             <link href="{{ asset('css/app.css') }}" rel="stylesheet">
             <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
            <!-- Ajax -->
             <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
             <!-- fullcalendar -->
             <!--js-->
             <script src="{{ asset('js/fullcalendar/main.js') }}"></script>
            <!--css-->
            <link href="{{ asset('css/fullcalendar/main.css') }}" type="text/css" rel='stylesheet' />


            <script src="{{ asset('js/fullcalendar.js') }}" defer></script>
            <script src="{{ asset('js/event-control.js') }}" defer></script>
            <script src="{{ asset('js/ajax-setup.js') }}" defer></script>
        </head>
        <body>

            <div id="app">
                  <nav class="navbar fixed-top navbar-dark bg-dark navbar-laravel">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <a class="navbar-brand">アプリ名</a>
                        </div>
                    </div>


                  </nav>
                <main class="mt-10">
                    @yield('content')
                </main>
            </div>
        </body>
</html>
