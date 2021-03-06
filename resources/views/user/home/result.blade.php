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
    <div class="container top-div">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Tin nhắn</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if( !empty($message) )
                            @if( $message['check'] )
                                <center style="margin-top: 30px;" class="text-success">{!! $message['message'] !!}</center>
                            @else
                                <center style="margin-top: 30px;" class="text-danger">{!! $message['message'] !!}</center>
                            @endif
                        @endif
                        <div>
                            <a href="/home" class="btn btn-primary" style="margin-top: 100px;">Thành viên</a>
                            <a href="/index" class="btn btn-primary" style="margin-top: 100px;">Quay lại trang chủ</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
