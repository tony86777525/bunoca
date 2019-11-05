@inject('mainPresenter', 'App\Presenters\MainPresenter')
<div class="card">
    <div class="card-header">
        <div class="btn">{{ $mainPresenter->showText('shoppingCart') }}<small class="ml-3 text-secondary">{{ count($order_list) }} {{ $mainPresenter->showText('orderDetailCount') }}</small></div>
        @include('home.common.userMailCheck')
    </div>
    <div class="card-body message-board">
        <form id="create-order-form" action="#" method="POST" onsubmit="return false">
            @if(!empty($order_list))
                <table class="table table-hover" style="border: 1px solid #dee2e6; font-size: 12px">
                    <tbody>
                    <?php $total_price = 0 ?>
                    @foreach($order_list as $ol)
                        <tr>
                            <td><a href="{{ $product_single[$ol['ps_id']]['ps_href'] }}" target="_blank"><img width="100" src="{{env('APP_URL').'/uploads/'.$product_single[$ol['ps_id']]['ps_image']}}"></a></td>
                            <td><a href="{{ $product_single[$ol['ps_id']]['ps_href'] }}" target="_blank">{{ $product_single[$ol['ps_id']]['ps_title'] }}</a></td>
                            <td><button type="button" class="close js-delete-order-detail" data-id="{{ $ol['ps_id'] }}"><span aria-hidden="true">×</span></button></td>
                        </tr>
                        <tr class="ps-modify">
                            <td colspan="2">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-outline-secondary rounded-0 js-button-add" type="button" data-id="ps_quantity_{{ $ol['ps_id'] }}" data-value="1">+</button>
                                    </div>
                                    <input type="text" class="form-control text-center" name="ps_quantity" data-id="{{ $ol['ps_id'] }}" id="ps_quantity_{{ $ol['ps_id'] }}" style="max-width: 45px" value="{{ $ol['ps_quantity'] }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary rounded-0 js-button-add" type="button" data-id="ps_quantity_{{ $ol['ps_id'] }}" data-value="-1" @if($ol['ps_quantity'] <= 1) disabled @endif >-</button>
                                    </div>
                                </div>
                            </td>
                            <td><span class="price">{{ $product_single[$ol['ps_id']]['ps_price'] * $ol['ps_quantity'] }}đ</span></td>
                            <?php $total_price += $product_single[$ol['ps_id']]['ps_price'] * $ol['ps_quantity'] ?>
                        </tr>
                    @endforeach
                </tbody>
                <table class="table table-hover" style="border: 1px solid #dee2e6; font-size: 12px">
                    <tr>
                        <td colspan="3">
                            <div class="row">
                                <div class="offset-md-6 col-md-6">
                                    <div>小計： <span class="float-right price text-dark font-weight-light">{{ $total_price }}đ</span></div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <div class="row">
                                <div class="offset-md-6 col-md-6">
                                    <span class="text-secondary">{{ count($order_list) }}{{ $mainPresenter->showText('shoppingCartCount') }}</span>
                                    <span class="float-right price">{{ $total_price }}đ</span>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <div class="row">
                                <div class="offset-md-6 col-md-6">
                                    <div><label>{{ $mainPresenter->showText('userName') }}：</label><input type="text" name="user_name" value="{{ Auth::user()->name }}"></div>
                                    <div><label>{{ $mainPresenter->showText('userAddress') }}：</label><input type="text" name="user_address" value="{{ Auth::user()->address }}"></div>
                                    <div class="mt-3">
                                        @if(!empty(Auth::user()->create_token))
                                            <div class="btn btn-success w-100 js-send_check_mail">{{ $mainPresenter->showText('userMailCheck') }}</div>
                                        @else
                                            <button class="btn btn-danger w-100 js-create-order">{{ $mainPresenter->showText('shoppingCartToPay') }}</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            @else
                {{ $mainPresenter->showText('shoppingCartNoCount') }}
            @endif
        </form>
    </div>
    @include('home.tool')
</div>
