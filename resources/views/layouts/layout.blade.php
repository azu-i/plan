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
             <link href="{{ asset('css/calendar.css') }}" rel="stylesheet">
             <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
            <!-- Ajax -->
             <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
             <!--js-->
             <script src="{{ asset('js/fullcalendar/main.js') }}"></script>
            <!--css-->
            <link href="{{ asset('css/fullcalendar/main.css') }}" type="text/css" rel='stylesheet' />
            <link href="{{ asset('css/calendar.css') }}" type="text/css" rel='stylesheet'>

            <script src="{{ asset('js/fullcalendar.js') }}" defer></script>
            <script src="{{ asset('js/event-control.js') }}" defer></script>
            <script src="{{ asset('js/ajax-setup.js') }}" defer></script>
            <script src="{{ asset('js/rrule/rrule.min.js') }}" defer></script>
            <script src='https://cdn.jsdelivr.net/npm/rrule@2.6.4/dist/es5/rrule.min.js'></script>
        </head>
        <body class="p">
            <div id="app">
                <nav class="navbar fixed-top navbar-dark bg-dark navbar-expand-lg">
                    <a class="navbar-header" href="{{ url('/calendar') }}">
                        <img class="logo" src={{ asset("image/logo.png") }} height="50" width="140">
                    </a>
                    <button class="navbar-toggler" type="button " data-toggle="collapse" data-target="#navmenu1" aria-controls="navmenu1" aria-expanded="false"aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navmenu1">
                            {{-- ログインしていない場合 ログインボタン --}}
                            <div class="navbar-nav">
                                <a class="nav-item nav-link" href="{{ url('/plan') }}">予定登録</a>
                            </div>
                            <div class="navbar-nav">
                                <a class="nav-item nav-link" href="{{ url('/users') }}">フォロー画面</a>
                            </div>
                            <div class="navbar-nav">
                                <a class="nav-item nav-link" href="{{ url('users/{user_id}/detail') }}">ユーザー情報</a>
                            </div>
                            @guest
                            {{-- ログインしていたらユーザー名とログアウトボタンを表示 --}}
                            @else
                                <div class="dropdown navbar-nav">
                                    <a id="navbarDropdown nav-item" class="btn btn-outline-dark dropdown-toggle " href="#" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:white;">
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                    </div>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            @endguest
                        </div>
                </nav>
            </div>
                <main style="padding-top:80px">
                    @yield('content')
                </main>
        </body>
</html>
