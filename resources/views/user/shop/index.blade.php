@inject('mainPresenter', 'App\Presenters\MainPresenter')
@extends('user.basic.main')

@section('pageCss')
    <link rel="stylesheet" href="{{ asset('css/shop/index.css') }}">
@endsection

@section('pageJs')
    <script src="{{ asset('js/shop/index.js') }}"></script>
@endsection

@section('navbar')
    @include('user.basic.header')
@endsection

@section('footer')
    @include('user.basic.footer')
@endsection

@section('contents')
    <div class="top-div">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('uploads/' . $product->p_image) }}" class="d-block w-100 top-img" alt="...">
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <input type="hidden" name="p_id" value="{{ $product->id }}">
            @foreach($product->product_single as $ps)
                <div class="col-12 space bg-light card">
                    <p class='title wow fadeInLeft'>{{$ps->ps_title}}</p>
                    <div class="row">
                        <div class="col-12 col-md-6 wow fadeIn" data-wow-delay="0.6s">
                            <p class='text-right wow fadeInLeft price'>{{ $mainPresenter->getPrice($ps->ps_price > 0 ? $ps->ps_price : $product->p_price) }}</p>
                            <div class="text content-text">
                                <?= $ps->ps_content ?>
                            </div>
                            <hr>
                            <form class="js-add-item" action="#" method="post" onsubmit="return false">
                                <input type="hidden" name="ps_id" value="{{$ps->id}}">
                                <div class="input-group">
                                    <div class="mr-2" style="line-height: 30px;">Số lượng:</div>
                                    <div class="input-group-prepend">
                                        <button class="btn btn-outline-secondary rounded-0 js-button-add" type="button" data-id="ps_quantity_{{$ps->id}}" data-value="1">+</button>
                                    </div>
                                    <input type="text" class="form-control text-center" name="ps_quantity" id="ps_quantity_{{$ps->id}}" style="max-width: 40px" value="1">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary rounded-0 js-button-add" type="button" data-id="ps_quantity_{{$ps->id}}" data-value="-1" disabled>-</button>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <button class="btn btn-danger w-100" type="submit">Mua ngay</button>
                                </div>
                            </form>
                        </div>
                        @if($ps->ps_image)
                            <div class="col-12 col-md-6 wow fadeIn" data-wow-delay="1.2s">
                                <div class="pic">
                                    <a href="{{ $ps->ps_href }}" target="_blank"><img class="img-responsive" width="100%" src="{{ asset('uploads/' . $ps->ps_image) }}"></a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
