<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/css/common/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/common/animate.css">
    <link rel="stylesheet" href="/css/common/sweetalert2.min.css">
    <link rel="stylesheet" href="/css/common/toastr.min.css">
    <link rel="stylesheet" href="/css/common/nprogress.css">
    <link rel="stylesheet" href="/css/auth/index.css">
    <link rel="stylesheet" href="/css/home/index.css">

    <link rel="icon" href="/img/index/logo.png" type="image/x-icon">
    <title>BUNOCA VIETNAM</title>
</head>
<body>
@inject('mainPresenter', 'App\Presenters\MainPresenter')

@include('index.common.header')

<div id="pjax-container">
    <div class="container top-div">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if(empty($page))
                    @include('home.index')
                @else
                    @include('home.'.$page)
                @endif
            </div>
        </div>
    </div>
</div>

<div>
    @include('index.common.footer')
</div>

<script src="/js/common/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="/js/common/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="/js/common/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
<script src="/js/common/wow.min.js"></script>
<script src="/js/common/jquery-2.1.4.min.js"></script>
<script src="/js/common/sweetalert2.min.js"></script>
<script src="/js/common/jquery.pjax.js"></script>
<script src="/js/common/nprogress.js"></script>
<script src="/js/common/toastr.min.js"></script>
<script src="/js/common/jquery.blockUI.js"></script>
<script src="/js/home/index.js"></script>
</body>
</html>

<script>
new WOW().init();
</script>

