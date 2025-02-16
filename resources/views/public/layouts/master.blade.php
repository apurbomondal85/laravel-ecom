<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" type="text/css" href="{{asset("frontend/css/plugins/animate.min.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("frontend/css/plugins/animation.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("frontend/css/plugins/swiper.min.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("frontend/css/style.css")}}">
    <link rel="shortcut icon" href="{{asset("frontend/images/favicon.ico")}}">
    <link rel="apple-touch-icon-precomposed" href="{{asset("frontend/images/favicon.ico")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("frontend/css/plugins/sweetalert.min.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("frontend/css/custom.css")}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    @stack('styles')
</head>
<body>
    @include('public.components.header')
    
    @yield('content')

    @include('public.components.footer')

    <div id="scrollTop" class="visually-hidden end-0"></div>
    <div class="page-overlay"></div>

    <script src="{{ asset('frontend/js/plugins/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/js/plugins/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/js/plugins/bootstrap-slider.min.js') }}"></script>
    <script src="{{ asset('frontend/js/plugins/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/js/plugins/countdown.js') }}"></script>
    <script src="{{ asset('frontend/js/theme.js') }}"></script>
    <script src="{{ asset('frontend/js/plugins/zoom.js') }}"></script>

    @stack('scripts')

    <script>
        var BASE_URL = "{{ url('/') }}";
    </script>
</body>
</html>
