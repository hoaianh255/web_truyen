
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <base href="{{asset('')}}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{asset('js/jqurey.js')}}" ></script>
    <script src="{{asset('js/slick.js')}}" ></script>

    <script src="{{asset('js/slideshow.js')}}" ></script>
    <script src="{{asset('js/collection.js')}}" ></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://kit.fontawesome.com/7da7bccd11.js" crossorigin="anonymous"></script>
    <!-- Styles -->
    <livewire:styles>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('css/slick.css')}}">
    <link rel="stylesheet" href="{{asset('css/slick-theme.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">

</head>
<body>
    <div id="app">
        <div class="container">
            <div style="height: 30px" class="col-12 bg-dark-mysite">
                <ul class="nav nav-top float-right">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Liên hệ: 1234545</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href=":email">Email: hoaianh@gmail.com</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Địa chỉ: 12/34 Linh Nam, Tây Ninh</a>
                    </li>

                </ul>
            </div>
            <header class="bg-navbar-mysite">
                <nav class="navbar navbar-expand-md navbar-dark col-md-12">
                    <a class="navbar-brand" href="/"><img src="images/logo2.png" width="80px" alt=""></a>
                    <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
                            aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-right"></i>
                    </button>
                    <div class="collapse navbar-collapse" id="collapsibleNavId">
                        <ul class="navbar-nav mr-auto mt-2 mt-lg-0 menu">
                            <li class="nav-item ">
                                <a class="nav-link link" href="{{url('/')}}">Trang chủ</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link link" href="{{route('about')}}">Giới thiệu</a>
                            </li>
                            <li class="nav-item theloai">
                                <a class="nav-link link " href="{{route('product')}}">Truyện tranh</a>
                            </li>
                            <li class="nav-item theloai">
                                <a class="nav-link link" href="{{route('post')}}">Bài viết</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link link" href="{{route('contact')}}">Báo cáo</a>
                            </li>
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    <livewire:search-dropdown>
                    </div>
                </nav>
            </header>
        </div>

        <main class="container">
            @yield('content')
        </main>
    </div>

    <script type="text/javascript">

            $('.slide-one').slick({
                autoplay: true,
                speed: 300,
                slidesToShow: 5,
                slidesToScroll: 1,

            });
    </script>
    <livewire:scripts>
</body>
</html>
