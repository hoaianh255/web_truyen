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
    <script src="{{asset('js/jqurey.js')}}" ></script>
    <script src="{{asset('js/slick.js')}}" ></script>

    <script src="{{asset('js/slideshow.js')}}" ></script>
    <script src="{{asset('js/collection.js')}}" ></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://kit.fontawesome.com/7da7bccd11.js" crossorigin="anonymous"></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/slick.css')}}">
    <link rel="stylesheet" href="{{asset('css/slick-theme.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body>
<div class="maincontent">
    <div class="topbar" id="topbar">
        <a href="{{ route('product.show',$product->slug) }}"><img src="{{asset('/images/back.png')}}" width="40px" height="auto" alt=""></a>
        <h1>Chương {!! $chapter->chapter !!}</h1>
        <div class="icon-feature">
            <a href=""><i class="fas fa-heart"></i></a>
            <a href="{{route('contact')}}"><i class="fas fa-exclamation-circle"></i></a>
        </div>
    </div>
    <div class="image-content">
        @foreach($listimage as $row)
            <img alt="" src="{{asset("storage/$product->id/$chapter->id/$row->name")}}">
        @endforeach

    </div>
    <div class="bottombar" id="bottombar">
        @if($chapter->chapter == 1)
            <a href="#"><i class="fas fa-chevron-left"></i></a>
            <a href="{{route('nextchap',[$product->slug,$chapter->slug])}}"><i class="fas fa-chevron-right"></i></a>
        @elseif($chapter->chapter == $max)
            <a href="{{route('prevchap',[$product->slug,$chapter->slug])}}"><i class="fas fa-chevron-left"></i></a>
            <a href="#" onclick="alert('Đây là chương mới nhất. Bạn hãy theo dõi website để xem chương tiếp theo nhé')"><i class="fas fa-chevron-right"></i></a>
        @else
            <a href="{{route('prevchap',[$product->slug,$chapter->slug])}}"><i class="fas fa-chevron-left"></i></a>
            <a href="{{route('nextchap',[$product->slug,$chapter->slug])}}"><i class="fas fa-chevron-right"></i></a>
        @endif
    </div>
</div>

</body>
</html>
