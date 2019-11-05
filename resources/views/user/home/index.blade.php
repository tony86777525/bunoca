@inject('mainPresenter', 'App\Presenters\MainPresenter')
@extends('user.basic.mainHome')

@section('pageCss')
    <link rel="stylesheet" href="{{ asset('css/home/index.css') }}">
@endsection

@section('pageJs')
    <script src="{{ asset('js/home/index.js') }}"></script>
@endsection

@section('navbar')
    @include('user.basic.header')
@endsection

@section('footer')
    @include('user.basic.footer')
@endsection

@section('contents')
    <div class="card">
        <div class="card-header">
            <div class="btn">{{ $mainPresenter->showText('message') }}</div>
            @include('user.home.common.userMailCheck')
        </div>
        <div class="card-body message-board">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="text-center align-bottom"><a href="/index" class="btn btn-primary" style="margin-top: calc(43vh - 100px);">{{ $mainPresenter->showText('goIndex') }}</a></div>
        </div>
        @include('user.home.common.tool')
    </div>
@endsection
