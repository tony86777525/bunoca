<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Title -->
    <link rel="icon" href="{{ asset('img/index/logo.png') }}" type="image/x-icon">
    <title>BUNOCA VIETNAM</title>
    <!-- Basic Css Start -->
    <link rel="stylesheet" href="{{ asset('css/common/bootstrap.min.css') }}" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/common/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common/nprogress.css') }}">
    <!-- Basic Css Start -->
    <!-- Page Css Start -->
    @yield('pageCss')
    <!-- Page Css End -->
</head>
<body>
    @yield('navbar')

    <div id="pjax-container">
        <div class="container top-div">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    @yield('contents')
                </div>
            </div>
        </div>
    </div>
    @yield('footer')
    <!-- Basic Js Start -->
    <script src="{{ asset('js/common/jquery-3.3.1.slim.min.js') }}" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="{{ asset('js/common/popper.min.js') }}" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="{{ asset('js/common/bootstrap.min.js') }}" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <script src="{{ asset('js/common/wow.min.js') }}"></script>
    <script src="{{ asset('js/common/jquery-2.1.4.min.js') }}"></script>
    <script src="{{ asset('js/common/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('js/common/jquery.pjax.js') }}"></script>
    <script src="{{ asset('js/common/nprogress.js') }}"></script>
    <script src="{{ asset('js/common/toastr.min.js') }}"></script>
    <script src="{{ asset('js/common/jquery.blockUI.js') }}"></script>
    <!-- Basic Js End -->
    <!-- Page Js Start -->
    @yield('pageJs')
    <!-- Page Js End -->
</body>
</html>
