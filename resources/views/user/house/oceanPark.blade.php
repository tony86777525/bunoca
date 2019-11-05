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
        <div id="carouselExampleIndicators" data-interval="3000" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('img/house/OceanPark/OP1.jpg') }}" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('img/house/OceanPark/OP2.jpg') }}" class="d-block w-100" alt="...">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <section>
                    <p class="text-center"><a href="https://www.vinhomeoceanpark.com.vn/" class="text-dark">www.vinhomeoceanpark.com.vn</a></p>
                </section>
                <section>
                    <p>
                        Vinhomes海洋公園創造了一個擁有6.1公頃鹹水湖和24.5公頃白沙湖的城市，建築密度
                        低至近19％，其特色包括健身公園，燒烤公園和數百個運動場等大型公用設施，未來
                        居民將享受游泳池、花園、遊樂場、醫療和各級學校，包括國際級的大學VinUni。
                    </p>
                </section>
                <section>
                    <div class="row">
                        <img src="{{ asset('img/house/OceanPark/OP3.jpg') }}" class="col-12 col-md-6" alt="...">
                        <img src="{{ asset('img/house/OceanPark/OP4.jpg') }}" class="col-12 col-md-6" alt="...">
                    </div>
                </section>
                <section>
                    <div class="card">
                        <img src="{{ asset('img/house/OceanPark/OP_Map1.jpg') }}" class="d-block w-100" alt="...">
                        <p>
                            Vinhomes海洋公園位於Gia Lam的黃金交匯處，離Vinh Tuy橋腳僅7分鐘路程，距離
                            Chuong Duong橋和Thanh Tri橋只有幾分鐘的路程，公交系統連接9個河內地區，8號捷
                            運線方便快捷地連接到河內市中心區，在交通方面具有很大的優勢。
                        </p>
                    </div>
                </section>
                <section>
                    <div class="card">
                        <img src="{{ asset('img/house/OceanPark/OP_AirPlane.jpg') }}" class="d-block w-100" alt="...">
                        <p>
                            Vinhomes海洋公園到河內機場只需要50分鐘的路程。
                        </p>
                    </div>
                </section>
                <section>
                    <div class="card">
                        <img src="{{ asset('img/house/OceanPark/OP_Map2.jpg') }}" class="d-block w-100" alt="...">
                        <p class="text">
                            項目面積：420公頃。
                        </p>
                        <p class="text">
                            交接公寓的時間：2020年8月。
                        </p>
                        <p class="text">
                            使用權50年；高級公寓類型，使用權55年。
                        </p>
                        <p class="text">
                            房型、實際坪數與基本售價(視樓層和位置而有差異)
                        </p>
                        <p class="text">
                            小資套房：26~38㎡；台幣130萬元起
                        </p>
                        <p class="text">
                            1房1廳：43~48㎡；台幣200萬元起
                        </p>
                        <p class="text">
                            2房1廳：55~66㎡；台幣280萬元起
                        </p>
                        <p class="text">
                            3房1廳：75~80㎡；台幣320萬元起
                        </p>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection