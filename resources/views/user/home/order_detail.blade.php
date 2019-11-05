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
            <div class="btn">{{ $mainPresenter->showText('orderNo') }} {{ $order->o_no }}<small class="ml-3 text-secondary">{{ count($order->order_detail) }} {{ $mainPresenter->showText('orderDetailCount') }}</small></div>
        </div>
        <div class="card-body message-board">
            <form id="create-order-form" action="#" method="POST" onsubmit="return false">
                @if(!empty($order))
                    <table class="table table-hover" style="border: 1px solid #dee2e6; font-size: 12px">
                        <tbody>
                        @foreach($order->order_detail as $od)
                            <tr>
                                <td><a href="{{ $od->product_single->ps_href }}" target="_blank"><img width="100" src="{{env('APP_URL').'/uploads/'.$od->product_single->ps_image}}"></a></td>
                                <td><a href="{{ $od->product_single->ps_href }}" target="_blank">{{ $od->product_single->ps_title }}</a></td>
                                <td></td>
                            </tr>
                            <tr class="ps-modify">
                                <td colspan="2">
                                    <div class="text-center h3" style="max-width: 45px">{{ $od->od_num }}</div>
                                </td>
                                <td><span class="price">{{ $od->od_money }}đ</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                    <table class="table table-hover" style="border: 1px solid #dee2e6; font-size: 12px">
                        <tr>
                            <td colspan="3">
                                <div class="row">
                                    <div class="offset-md-6 col-md-6">
                                        <div>{{ $mainPresenter->showText('orderLittleTotal') }}： <span class="float-right price text-dark font-weight-light">{{ $order->o_money }}đ</span></div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <div class="row">
                                    <div class="offset-md-6 col-md-6">
                                        <span class="text-secondary">{{ count($order->order_detail) }} {{ $mainPresenter->showText('orderDetailCount') }}</span>
                                        <span class="float-right price">{{ $order->o_pay_money }}đ</span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <div class="row">
                                    <div class="offset-md-6 col-md-6">
                                        <div><label>{{ $mainPresenter->showText('userName') }}：</label>{{ Auth::user()->name }}</div>
                                        <div><label>{{ $mainPresenter->showText('userAddress') }}：</label>{{ Auth::user()->address }}</div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                @else
                    {{ $mainPresenter->showText('orderNoCount') }}
                @endif
            </form>
        </div>
        @include('user.home.common.tool')
    </div>
@endsection
