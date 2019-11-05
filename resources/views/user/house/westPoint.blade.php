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
        <img src="{{ asset('img/house/WestPoint/WP1.jpg') }}" class="d-block mx-auto w-100" alt="...">
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <section>
                    <p class="text-center"><a href="https://www.westpoint.vinhomes.vn/" class="text-dark">www.westpoint.vinhomes.vn</a></p>
                    <p>
                        Vinhomes West Point是河內市西區罕見的項目之一，鄰近Vinhomes Skylake Pham Hung
                        和Vinhomes Green Bay Me Tri的兩座湖。
                    </p>
                </section>
                <section>
                    <div class="card">
                        <img src="{{ asset('img/house/WestPoint/WP2.jpg') }}" class="d-block w-100" alt="...">
                    </div>
                </section>
                <section>
                    <div class="card">
                        <img src="{{ asset('img/house/WestPoint/WP3.jpg') }}" class="d-block w-100" alt="...">
                    </div>
                </section>
                <section>
                    <div class="card">
                        <img src="{{ asset('img/house/WestPoint/WP4.jpg') }}" class="d-block w-100" alt="...">
                    </div>
                </section>
                <section>
                    <div class="card">
                        <img src="{{ asset('img/house/WestPoint/WP_Map1.png') }}" class="d-block w-100" alt="...">
                        <p>
                            河內市博物館、國家會議中心及世貿中心National Architectural Planning &amp; Construction
                            Exhibition就在家的對面。
                        </p>
                    </div>
                </section>
                <section>
                    <div class="card">
                        <img src="{{ asset('img/house/WestPoint/WP_Map2.jpg') }}" class="d-block w-100" alt="...">
                        <p>
                            Vinhomes West Point的項目規劃中有3棟高級公寓樓，位於Do Duc Duc和Pham Hung十
                            字路口的A級辦公室區域，離機場約50分鐘路程。
                        </p>
                    </div>
                </section>
                <section>
                    <div class="card">
                        <img src="{{ asset('img/house/WestPoint/WP_Map3.jpg') }}" class="d-block w-100" alt="...">
                        <p class="text">項目面積：2.4公頃。</p>
                        <p class="text">交接公寓的時間：2020年4月。</p>
                        <p class="text">WEST 1：Officetel，高39層，相當於台幣7.5萬/平方米（含高檔裝潢）。</p>
                        <p class="text">WEST 2：高級公寓，高39層，相當於台幣8.1萬/平方米（含高檔裝潢）。</p>
                        <p class="text">WEST 3：高級公寓，高35層，相當於台幣8.1萬/平方米（含高檔裝潢）。</p>
                        <p class="text">所有權形式：Officetel類型，使用權50年；高級公寓類型，使用權55年。</p>
                        <p class="text">房型、實際坪數與基本售價(視樓層和位置而有差異)</p>
                        <p class="text">小資套房：35.6 ~ 40.1㎡；台幣300萬元起(即將售完)</p>
                        <p class="text">2房1廳：65.6 ~ 74.8㎡；台幣520萬元起</p>
                        <p class="text">3房1廳：99.5 ~ 109.3㎡；台幣770萬元起</p>
                        <p class="text">4房1廳：129.3 ~ 139.1㎡；台幣990萬元起</p>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection