<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" type="text/css" href="{{asset("admin/css/animate.min.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("admin/css/animation.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("admin/css/bootstrap.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("admin/css/bootstrap-select.min.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("admin/css/style.css")}}">
    <link rel="stylesheet" href="{{asset("admin/font/fonts.css")}}">
    <link rel="stylesheet" href="{{asset("admin/icon/style.css")}}">
    <link rel="shortcut icon" href="{{asset("admin/images/favicon.ico")}}">
    <link rel="apple-touch-icon-precomposed" href="{{asset("admin/images/favicon.ico")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("admin/css/sweetalert.min.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("admin/css/custom.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("admin/css/image-uploader.min.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("admin/css/image-uploader.css")}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" integrity="sha512-rqQltXRuHxtPWhktpAZxLHUVJ3Eombn3hvk9PHjV/N5DMUYnzKPC1i3ub0mEXgFzsaZNeJcoE0YHq0j/GFsdGg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    @stack('styles')
</head>
<body>
    <div id="wrapper">
        <div id="page" class="">
            <div class="layout-wrap">
                @include('admin.components.sidebar')

                <div class="section-content-right">
                    @include('admin.components.header')

                    <div class="main-content">
                        <div class="main-content-inner">
                            @yield('content')
                        </div>

                        <div class="bottom-page">
                            <div class="body-text">Copyright © 2024 SurfsideMedia</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{asset("admin/js/jquery.min.js")}}"></script>
    {{-- <script src="{{asset("admin/js/bootstrap.min.js")}}"></script> --}}
    <script src="{{asset("admin/js/bootstrap.bundle.min.js")}}"></script>
    <script src="{{asset("admin/js/image-uploader.min.js")}}"></script>
    <script src="{{asset("admin/js/image-uploader.js")}}"></script>
    <script src="{{asset("admin/js/bootstrap-select.min.js")}}"></script>   
    <script src="{{asset("admin/js/sweetalert.min.js")}}"></script>    
    <script src="{{asset("admin/js/apexcharts/apexcharts.js")}}"></script>
    <script src="{{asset("admin/js/main.js")}}"></script>
    @vite('resources/admin/js/helper.js')
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    @stack('scripts')

    <script>
        var BASE_URL = "{{ url('/') }}";
    </script>
    <script>
        
        $(function () {
            $('.dropMeInputImage').imageUploader({
                maxSize: 2 * 1024 * 1024,
                maxFiles: 5
            });
        });

    </script>
</body>
</html>
