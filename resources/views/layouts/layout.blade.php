<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <title>@yield('title')</title>

            <script src="{{secure_asset('js/app.js') }}"></script>
            @yield('js')

             <!-- Fonts -->
             <link rel="dns-prefetch" href="https://fonts.gstatic.com">
             <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

             <!-- Styles -->
             <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
             <link href="{{ secure_asset('css/layout.css') }}" rel="stylesheet">
             <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
            <!-- Ajax -->
             <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
             <!-- fullcalendar -->
             <script src='/js/fullcalendar/core/main.js'></script>
            <script src='/js/fullcalendar/daygrid/main.js'></script>
            <script src='/js/fullcalendar/interaction/main.js'></script>

            <link href='/css/fullcalendar/core/main.css' type="text/css" rel='stylesheet' />
            
            <link href='/calendar/daygrid/main.css' type="text/css" rel='stylesheet' />

            <link rel='stylesheet' href='fullcalendar/fullcalendar.css' />
            <script src='lib/jquery.min.js'></script>
            <script src='lib/moment.min.js'></script>
            <script src='fullcalendar/fullcalendar.js'></script>

            <script src="/js/ajax-setup.js"></script>
            <script src='/js/fullcalendar.js'></script>
            <script src='/js/event-control.js'></script>
        </head>
        <body>

            <div id="app">
                  <nav class="navbar fixed-top navbar-dark bg-dark navbar-laravel">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <a class="navbar-brand">Plan Adelane</a>
                        </div>
                    </div>


                  </nav>
                <main>
                    @yield('content')
                </main>
            </div>
        </body>
</html>
