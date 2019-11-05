@extends('user.basic.main')

@section('pageCss')
    <link rel="stylesheet" href="{{ asset('css/house/index.css') }}">
@endsection

@section('pageJs')
    <script src="{{ asset('js/index/index.js') }}"></script>
@endsection

@section('navbar')
    @include('user.basic.header')
@endsection

@section('footer')
    @include('user.basic.footer')
@endsection

@section('contents')
    <div class="top-content d-none d-sm-block">
        <h5><a href="{{ route('house') }}"><img width="150" src="{{ asset('img/house/logo.svg') }}"></a></h5>
    </div>
    <div class="top-div">
        <img src="{{ asset('img/house/top.jpg') }}" class="d-block mx-auto w-100" alt="...">
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <section>
                    <p class="text-center"><a href="https://www.vinhomes.vn" class="text-dark">www.vinhomes.vn</a></p>
                    <p class='title'>公司介紹</p>
                    <p class="text">
                      Vinhomes(<a href="https://www.vinhomes.vn">www.vinhomes.vn</a>)是越南最大的商業房地產開發商，成立於2018年，是Vingroup的子公司，該公司已成為越南第二大上市公司，僅次於Vingroup母公司。
                    </p>
                    <p class="text">
                        Vinhomes在越南的40個城市開發房產，在越南擁有16,000公頃（62平方英里）的土地，也是越南最高建築物Landmark 81(位於胡志明市)的所有者。
                    </p>
                    <p class="text">
                        房型、坪數、格局都與台灣近似，地理位置優越，非常適合台灣人海外房地產自用或投資。
                    </p>
                </section>

                <section>
                    <p class='title body-text'>案場</p>
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <a href="{{ route('smartCity') }}">
                                <img src="{{ asset('img/house/SmartCity/SC_1.jpg') }}" width="100%" height="200" alt="...">
                                <div class="card-body">
                                    <p class='title text-dark'>SmartCity</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-12 col-md-4">
                            <a href="{{ route('westPoint') }}">
                                <img src="{{ asset('img/house/WestPoint/WP1.jpg') }}" width="100%" height="200" alt="...">
                                <div class="card-body">
                                    <p class='title text-dark'>WestPoint</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-12 col-md-4">
                            <a href="{{ route('oceanPark') }}">
                                <img src="{{ asset('img/house/OceanPark/OP1.jpg') }}" width="100%" height="200" alt="...">
                                <div class="card-body">
                                    <p class='title text-dark'>OceanPark</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection