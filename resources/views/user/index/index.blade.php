@inject('mainPresenter', 'App\Presenters\MainPresenter')
@extends('user.basic.main')

@section('pageCss')
    <link rel="stylesheet" href="{{ asset('css/index/index.css') }}">
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
    <div class="top-div">
        <div id="carouselExampleIndicators" data-interval="3000" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                @foreach($mainPresenter->productList() as $key => $product)
                    <li data-target="#carouselExampleIndicators" data-slide-to="<?= $key+1 ?>"></li>
                @endforeach
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="/img/index/top.jpg" class="d-block w-100 top-img top-img-opacity" alt="...">
                    <div class="top-content d-none d-sm-block wow fadeInDown">
                        <h5 class="wow heartBeat" data-wow-delay="0.8s"><img width="100" src="/img/index/logo.png"></h5>
                        <p>BUNOCA VIETNAM</p>
                    </div>
                </div>
                @foreach($mainPresenter->productList() as $product)
                    <div class="carousel-item">
                        <a href="{{ route('shop', ['id' => $product->id]) }}/" target="_blank"><img src="/uploads/{{$product->p_image}}" class="d-block w-100 top-img" alt="..."></a>
                    </div>
                @endforeach
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
    <div class="container space">
        <div class="row">
            <div class="col-12 space bg-light card" id="about">
                <p class='title wow fadeInLeft'>GIỚI THIỆU</p>
                <div class="row">
                    <div class="col-12 col-md-6 wow fadeIn" data-wow-delay="0.6s">
                        <p class="text">
                            Bunoca Viet Nam tự hào là Công ty thương mại chuyên xuất nhập khẩu các sản phẩm chất lượng cao của Đài Loan và Việt Nam. Các sản phẩm bao gồm: mỹ phẩm, thực phẩm bổ dưỡng, các sản phẩm bảo vệ sức khỏe, thực phẩm, và rất nhiều các sản phẩm khác đảm bảo chất lượng.
                            Chúng tôi cam kết sẽ là cầu nối để đưa các sản phẩm chất lượng cao tốt nhất của Đài Loan đến với người tiêu dùng Việt Nam, và Việt Nam đến Đài Loan. Để người tiêu dùng cả 2 nơi có thể thưởng thức, sử dụng các sản phẩm tốt nhất của nhau.
                            Giá của các sản phẩm trên trang web chính thức là giá bán buôn, vì vậy mô hình của Bunoca Viet Nam là hình thức bán buôn.
                        </p>
                        <p class="text font-weight-bold font-italic">
                            Bạn luôn được chào đón là đại lý khu vực các sản phẩm của chúng tôi. Bạn cũng có thể tìm thấy các sản phẩm Đài Loan bạn cần hoặc các sản phẩm Việt Nam bạn muốn xuất khẩu sang Đài Loan.
                        </p>
                    </div>
                    <div class="col-12 col-md-6 wow fadeIn" data-wow-delay="1.2s">
                        <div class="pic">
                            <img class="img-responsive" width="100%" src="/img/index/about.jpg">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 space bg-light card" id="companyLocation">
                <p class='title wow fadeInLeft'>公司位置</p>
                <center>
                    <div id="map" class="wow flipInX" data-wow-delay="0.6s"><img src="/img/index/map.jpg" style="max-width: 100%;"></div>
                </center>
            </div>
        </div>
    </div>
@endsection
