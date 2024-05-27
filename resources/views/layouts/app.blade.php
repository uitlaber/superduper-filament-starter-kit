<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400&display=swap"
        rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        <x-slider />
        <div class="header">
            <div class="header__top">
                <div class="container">
                    <ul class="user-nav">
                        <li><a href="#">Мобильная версия</a></li>
                        @guest
                        <li><a href="{{ route('login') }}">Личный кабинет</a></li>
                        @else
                        <li><a href="/login">Личный кабинет</a></li>
                        @endguest
                    </ul>
                </div>
            </div>
            <div class="header__bot">
                <div class="container">
                    <div class="header__grid">
                        <a href="/" class="header-logo"><img src="/images/logo.png" alt=""></a>
                        <ul class="header-nav">
                            <li><a href="#">Главная</a></li>
                            <li><a href="#">Услуги</a></li>
                            <li><a href="#">Каталог</a></li>
                            <li><a href="#">Клуб риелторов</a></li>
                            <li><a href="#">Аналитика</a></li>
                            <li><a href="#">Статус <span class="badge">PRO</span></a></li>
                            <li><a href="#">Еще...</a>
                                <div class="nav-submenu">
                                    <ul>
                                        <li><a href="#">СМИ</a></li>
                                        <li><a href="#">СМИ</a></li>
                                        <li><a href="#">СМИ</a></li>
                                        <li><a href="#">СМИ</a></li>
                                        <li><a href="#">СМИ</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                        
                    </div>
                </div>
            </div>
        </div>
      

        <main >
            @yield('content')
        </main>
    </div>
</body>

</html>
