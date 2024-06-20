<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
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

    @livewireStyles

</head>

<body>

    <div id="app">
        <x-slider />
        <div class="header">
            <div class="header__top">
                <div class="container">
                    <div class="header__top__grid">
                        <a href="/" class="header-logo ml-2"><img src="/images/logo.png" alt=""></a>
                        <ul class="user-nav">
                            <li><a href="#"><i class="bi bi-badge-ar"></i> <span>AR</span></a></li>
                            <li><a href="{{ route('objects.add') }}"><i class="bi bi-plus-square"></i> <span>Разместить
                                        объявление</span></a></li>

                            <li><a href="{{ route('favorites') }}"><i class="bi bi-heart"></i> <span>Избранные</span></a></li>  
                            @guest
                                <li><a href="{{ route('login') }}"><i class="bi bi-box-arrow-in-right" ></i>
                                        <span>Войти</span></a></li>
                            @else
                                <li><a href="/login"><i class="bi bi-person"></i> <span>Личный кабинет</span></a></li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </div>
            <div class="header__bot" x-data="{ open: false }">
                <div class="container">
                    <div class="header__grid">
                        <ul class="header-nav">
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

                        
                        <livewire:search-bar />

                        
                        <a href="#" class="burger-menu" x-on:click.prevent="open = !open"><svg
                                xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="30" height="30"
                                viewBox="0 0 50 50">
                                <path
                                    d="M 3 8 A 2.0002 2.0002 0 1 0 3 12 L 47 12 A 2.0002 2.0002 0 1 0 47 8 L 3 8 z M 3 23 A 2.0002 2.0002 0 1 0 3 27 L 47 27 A 2.0002 2.0002 0 1 0 47 23 L 3 23 z M 3 38 A 2.0002 2.0002 0 1 0 3 42 L 47 42 A 2.0002 2.0002 0 1 0 47 38 L 3 38 z">
                                </path>
                            </svg></a>

                        <ul class="header-nav--mobile" x-show="open" style="display: none;">
                            <li><a href="#">Главная</a></li>
                            <li><a href="#">Услуги</a></li>
                            <li><a href="#">Каталог</a></li>
                            <li><a href="#">Клуб риелторов</a></li>
                            <li><a href="#">Аналитика</a></li>
                            <li><a href="#">Статус <span class="badge">PRO</span></a></li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>

        <main>
            @yield('content')
        </main>
        <footer class="footer">
            <div class="container">
                <div class="footer__col">
                    <p>© 2023 — 2024 «Clickhome»</p>
                </div>
            </div>
        </footer>
    </div>
    @livewireScripts
</body>

</html>
