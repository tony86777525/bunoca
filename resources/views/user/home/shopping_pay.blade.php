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
            <div class="btn">{{ $mainPresenter->showText('orderNo') }} {{ $order->o_no }} {{ $mainPresenter->showText('orderPay') }}<small class="ml-3 text-secondary">{{ $order->order_detail->count() }} {{ $mainPresenter->showText('orderDetailCount') }}</small></div>
        </div>
        <div class="card-body message-board">
            @if(!empty($order))
                <table class="table table-hover" style="border: 1px solid #dee2e6; font-size: 12px">
                    <thead>
                    <tr>
                        <th scope="col">{{ $mainPresenter->showText('orderDetailType') }}</th>
                        <th scope="col">{{ $mainPresenter->showText('orderDetailNum') }}</th>
                        <th scope="col">{{ $mainPresenter->showText('orderDetailMoney') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($order->order_detail as $od)
                            <tr>
                                <td><a href="{{ $od->product_single->ps_href }}" target="_blank">{{ $od->product_single->ps_title }}</a></td>
                                <td>{{ $od->od_num }}</td>
                                <td>{{ $od->od_money }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
                                    <span class="text-secondary">{{ $order->order_detail->count() }} {{ $mainPresenter->showText('orderDetailCount') }}</span>
                                    <span class="float-right price">{{ $order->o_pay_money }}đ</span>
                                </div>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <div class="text-left font-weight-bold">{{ $mainPresenter->showText('orderPayTo') }}</div>
                    <table>
                        <tr>
                            <td><h3 class="font-weight-bold text-danger">{{ $mainPresenter->showText('configBank') }}： </h3></td>
                            <td><h3 class="font-weight-bold text-danger">{{ $config->bank }}</h3></td>
                        </tr>
                        <tr>
                            <td><h3 class="font-weight-bold text-danger">{{ $mainPresenter->showText('configCompany') }}： </h3></td>
                            <td><h3 class="font-weight-bold text-danger">{{ $config->company }}</h3></td>
                        </tr>
                        <tr>
                            <td><h3 class="font-weight-bold text-danger">{{ $mainPresenter->showText('configAccount') }}： </h3></td>
                            <td><h3 class="font-weight-bold text-danger">{{ $config->account }}</h3></td>
                        </tr>
                    </table>
                </div>
                <form id="shopping-pay-success-form" action="#" method="POST" onsubmit="return false">
                    <input type="hidden" name="o_no" value="{{ $order->o_no }}">
                    <div class="form-group text-right">
                        <label for="o_pay_image"><span class="o_pay_image_text btn btn-outline-danger font-weight-bold">{{ $mainPresenter->showText('orderPayAndUpload') }}</span></label>
                        <input type="file" id="o_pay_image" accept="image/jpeg, image/png" class="js-image hide" name="o_pay_image">
                        <button type="submit" class="btn btn-success js-shoppingPay-success" disabled>{{ $mainPresenter->showText('finish') }}</button>
                    </div>
                </form>
                <img id="o_pay_image_show" style="width: 100%; display: none;" alt="...">
            @else
                {{ $mainPresenter->showText('shoppingCartNoCount') }}
            @endif
        </div>
        @include('user.home.common.tool')
    </div>
@endsection
