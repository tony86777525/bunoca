@inject('mainPresenter', 'App\Presenters\MainPresenter')
<div class="card">
    <div class="card-header">
        <div class="btn">{{ $mainPresenter->showText('orderRecord') }}<small class="ml-3 text-secondary">{{ count($orders) }} {{ $mainPresenter->showText('orderCount') }}</small></div>
        @include('home.common.userMailCheck')
    </div>
    <div class="card-body message-board">
        <form id="create-order-form" action="#" method="POST" onsubmit="return false">
            @if(!empty($orders))
                <table class="table table-hover" style="border: 1px solid #dee2e6; font-size: 12px">
                    <thead>
                    <tr>
                        <th scope="col">{{ $mainPresenter->showText('orderNo') }}</th>
                        <th scope="col">{{ $mainPresenter->showText('orderMoney') }}</th>
                        <th scope="col">{{ $mainPresenter->showText('orderPayType') }}</th>
                        <th scope="col">{{ $mainPresenter->showText('orderDeliverType') }}</th>
                        <th scope="col">{{ $mainPresenter->showText('active') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <th scope="row">{{ $order->o_no }}</th>
                        <td>{{ $order->o_pay_money }}</td>
                        <td><span class="@if($order->o_pay_flg == App\Order::O_PAY_FLG_OFF) text-danger @else text-success @endif">{{ $mainPresenter->showText('orderPayFlg.' . $order->o_pay_flg) }}</span></td>
                        <td><span class="@if($order->o_deliver_flg == App\Order::O_DELIVER_FLG_OFF) text-danger @else text-success @endif">{{ $mainPresenter->showText('orderDeliverFlg.' . $order->o_deliver_flg) }}</span></td>
                        <td>
                            @if($order->o_pay_flg == App\Order::O_PAY_FLG_OFF)
                                <a class="btn btn-danger p-0" href="{{ route('shoppingPay', ['o_no' => $order->o_no]) }}">{{ $mainPresenter->showText('toOrderPay') }}</a>
                            @else
                                <a class="btn btn-success p-0" href="{{ route('orderDetail', ['o_no' => $order->o_no]) }}">{{ $mainPresenter->showText('toOrderDetail') }}</a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>{{ $mainPresenter->showText('userName') }}：{{ $order->user_name }}</td>
                        <td colspan="4">{{ $order->user_address }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                {{ $mainPresenter->showText('orderNoCount') }}
            @endif
        </form>
    </div>
    @include('home.tool')
</div>
